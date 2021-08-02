<?php

require 'autoloader.php';

/**
 * Classe qui permet de gérer l'export de données. Classe-fille d'AbstractController pour hériter des méthodes permettant de rendre une vue.
 */
class ExportController  {

    /**
     * Permet d'exporter les relevés souhaités au format CSV.
     *
     * @param  Export $exportInfo
     */
    public function exportRecords(){
        $exportManager = new ExportManager();
        $exportManager->exportRecords();
    }
}