<?php 

require_once 'DatabaseConnection.php';
require_once 'SimpleXLSXGen.php';

/**
 * Classe qui permet de gérer l'export de données.
 * Hérite de RecordManager pour pouvoir utiliser la méthode addQueryScopeAndOrderByClause().
 */
class ExportManager extends DatabaseConnection {

    public function __construct() {
        parent::__construct();
    }

    /**
     * Permet d'exporter des données selon les options sélectionnées dans le formulaire d'export.
     * 3 étapes : 
     * - récupérer le contenu à exporter, c'est-à-dire la liste des relevés
     * - écrire un nom de fichier pertinent en fonction des données exportées
     * - écrire le fichier CSV
     *
     * @param  Export $exportInfo
     */
    public function exportRecords(){
        $rows = $this->getRecordsToExport();
        $fileName = $this->getFileName();
        // $this->writeCsvFile($rows, $fileName);
        $this->writeXlsxFile($rows, $fileName);
    }
    
    /**
     * Permet de récupérer le contenu à exporter, c'est-à-dire la liste des relevés, selon les options choisies dans le formulaire d'export.
     * Retourne un tableau de relevés.
     *
     * @param  Export $exportInfo
     * @return array $rows
     */
    public function getRecordsToExport(){
        $pdo = $this->dbConnect();

        $sql = "SELECT 
            Releve.ID AS 'num_releve',
            Membre.Nom AS 'nom_salarie',
            Membre.Prenom AS 'prenom_salarie',
            Releve.tps_travail AS 'tps_travail_minutes',
            ROUND((Releve.tps_travail / 60), 2) AS 'tps_travail_heures',
            Releve.tps_trajet AS 'tps_trajet_minutes',
            ROUND((Releve.tps_trajet / 60), 2) AS 'tps_trajet_heures',
            Releve.commentaire,
            Releve.statut_validation AS 'statut_validation',
            Releve.date_hrs_creation AS 'date_heure_creation',
            Releve.date_hrs_modif AS 'date_heure_modification',
            Releve.supprimer AS 'releve_supprime',
            Affaire.Nom AS 'projet',
            Manager.Nom AS 'nom_manager',
            Manager.Prenom AS 'prenom_manager'
        FROM t_saisie_heure AS Releve
		   
		INNER JOIN t_affaires AS Affaire
			ON Releve.id_affaire = Affaire.ID
		   
		INNER JOIN t_login AS Membre
		   ON Releve.id_login = Membre.ID
		   
		INNER JOIN t_login AS Manager
			ON Releve.id_manager = Manager.ID";

        $query = $pdo->prepare($sql);
        $query->execute();
        $rows = $query->fetchAll(PDO::FETCH_ASSOC);

        $columnNames = array();

        if(!empty($rows)){
            $firstRow = $rows[0];

            foreach($firstRow as $colName => $value){
                $columnNames[] = $colName;
            }
        }

        array_unshift($rows, $columnNames);

        //$query->debugDumpParams();
        //echo'<br/>';
        //var_dump($rows);

        return $rows;
    }

 
    /**
     * Permet de construire le nom du fichier d'export en fonction des champs sélectionnés dans le formulaire d'export.
     *
     * @param  Export $exportInfo
     * @return string $fileName
     */
    public function getFileName(){
        $fileName = date('Ymd') . '_export_releves_heures' . '.xlsx';

        return $fileName;
    }

    /**
     * Permet d'écrire un fichier CSV.
     *
     * @param  array $rows
     * @param  string $fileName
     */
    public function writeCsvFile(array $rows, string $fileName){
        $columnNames = array();

        if(!empty($rows)){
            $firstRow = $rows[0];

            foreach($firstRow as $colName => $value){
                $columnNames[] = $colName;
            }
        }

        header("Content-type: text/csv ; charset=UTF-8");
        header('Content-Disposition: attachment; filename="' . $fileName . '"');

        // On crée un pointeur de fichier dans le flux output pour envoyer le fichier directement au navigateur
        $filePointer = fopen('php://output', 'w');
        fputcsv($filePointer, $columnNames);

        foreach ($rows as $row) {
            fputcsv($filePointer, $row);
        }

        fclose($filePointer);
    }

    public function writeXlsxFile(array $rows, string $filename) {
        

        $xlsxFile = SimpleXLSXGen::fromArray($rows);
        $xlsxFile->downloadAs($fileName);
    }
}