<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tour Guide Test</title>

    <!-- CDN pour charger Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous"/>

    <!-- Chargement des feuilles de style du tour guide -->
    <link href="node_modules/intro.js/introjs.css" rel="stylesheet" />
</head>

<body>
    
    <div class="container mt-5">
    <h1 class="display-5 text-center mb-5">TEST</h1>
    <h2 class="display-6 text-center">Tour Guide using <code>Intro.js</code></h2>

        <form action="#" method="POST">

            <div class="col mt-5 mb-5 text-center">
                <a class="btn btn-danger text-center" role="button" href="javascript:void(0);" onclick="javascript:introJs().start();"><i class="bi bi-info-circle"></i> Besoin d'aide ?</a>
            </div>

            
            
            <!-- Sélection du chantier et de la date du relevé -->
            <div id="divWorksiteInput" class="row mt-5 mb-3 d-flex justify-content-md-center">

                <div class="col mb-3" style="flex-grow: 2;" data-step="1" data-intro="Sélectionnez un projet pour lequel vous souhaitez relever des heures.">
                    <span class="input-group-text" id="worksite_selector">Projet</span>
                    <select class="form-select" name="worksiteId" id="selectWorksite" aria-label="Sélectionnez un projet" aria-describedby="worksite_selector" required>
                        <option value="" disabled selected>Sélectionnez un projet</option>
                    </select>
                </div>
                
                <div class="col flex-shrink-1 mb-3" data-step="2" data-intro="Indiquez la date de réalisation des heures.">
                    <span class="input-group-text" id="date_selector">Date</span>
                    <input type="date" name="recordDate" id="recordDate" class="form-control" aria-label="Sélectionnez une date" aria-describedby="date_selector" required/>
                </div>

            </div>

            <!-- Champs pour un relevé avec seulement une durée -->
            <div id="divWorkLengthInput" class="row mb-3 justify-content-md-center">

                <p class="h6 text-center mb-3">Temps de travail</p>

                <div class="col mb-3" data-step="3" data-intro="Indiquez le nombre d'heures de travail réalisées.">
                    <span class="input-group-text" id="work_hours_indicator">Heures</span>
                    <input type="number" min="-15" name="workLengthHours" id="workLengthHours" value="0" class="form-control" aria-label="Indiquez le nombre d'heures de trajet" aria-describedby="work_hours_indicator" required/>
                </div>

                <div class="col mb-3" data-step="4" data-intro="Au besoin, indiquez le nombre de minutes (palier de 15 minutes).">
                    <span class="input-group-text" id="work_minutes_indicator">Minutes</span>
                    <input type="number" min="-15" step="15" max="60" name="workLengthMinutes" value="0" id="workLengthMinutes" onchange="incrementHour(workLengthHours, workLengthMinutes)" class="form-control" aria-label="Indiquez le nombre de minutes de trajet" aria-describedby="work_minutes_indicator" required/>
                </div>

            </div>

            <!-- Champs pour un relevé avec gestion du temps de trajet -->
            <div id="divTripTimeInput" class="row mb-3 justify-content-md-center" data-step="5" data-intro="De la même manière, indiquez le nombre d'heures de trajet.">

                <p class="h6 text-center mb-3">Temps de trajet</p>

                <div class="col mb-3">
                    <span class="input-group-text" id="trip_hours_indicator">Heures</span>
                    <input type="number" min="-15" name="tripLengthHours" id="tripLengthHours" value="0" class="form-control" aria-label="Indiquez le nombre d'heures de trajet" aria-describedby="trip_hours_indicator" />
                </div>

                <div class="col mb-3">
                    <span class="input-group-text" id="trip_minutes_indicator">Minutes</span>
                    <input type="number" min="-15" step="15" max="60" name="tripLengthMinutes" id="tripLengthMinutes" value="0" onchange="incrementHour(tripLengthHours, tripLengthMinutes)" class="form-control" aria-label="Indiquez le nombre de minutes de trajet" aria-describedby="trip_minutes_indicator" />
                </div>

            </div>

            <!-- Champs commentaire -->
            <div id="divCommentFieldInput" class="row mb-3 justify-content-md-center">

                <div class="col mb-3"  data-step="6" data-intro="Une précision à apporter ? Laissez un commentaire !">
                    <span class="input-group-text" id="comment_section">Commentaire (facultatif)</span>
                    <textarea autocapitalize="sentences" maxlength="255" name="comment" id="recordComment" class="form-control" aria-label="Commentaire" aria-describedby="comment_section"></textarea>
                    <small class="form-text text-muted">255 caractères maximum</small>
                </div>

            </div>

            <div class="row mb-3 justify-content-md-center">
                
                <div class="col mb-5 text-center">
                    <input type="reset" value="Annuler" onclick="closeModal()" class="btn btn-light"/>
                    <input type="submit" value="Valider" class="btn btn-dark"  data-step="7" data-intro="C'est votre dernier mot ?"/>
                </div>
                
            </div>
        </form>

    </div>
    <!-- Script de fonctionnment du tour guide -->
	<script src="node_modules/intro.js/intro.js"></script>
</body>
</html>
