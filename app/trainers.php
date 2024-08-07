<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainers</title>
    <style> 
        #data_app{
            border:none;
        }

    </style>
    <script>
        <?php
            session_start();
            if (isset($_SESSION['prenotato'])) {
                if($_SESSION['prenotato']==true){
                    echo 'alert("Prenotazione effettuata!")';
                    $_SESSION['prenotato']=false;
                }else{
                    echo 'alert("Attenzione! Hai già una prenotazione attiva in questa data")';
                }
                unset( $_SESSION['prenotato']);
            }
            if (isset($_SESSION['trainereliminato'])) {
                echo 'alert("Trainer eliminato con successo!")';
                unset($_SESSION['trainereliminato']);
            }
        ?>

        function confermaEliminazione() {
            var conferma = confirm("Sei sicuro di voler procedere?");
            return conferma;
        }
    </script>
</head>
<body>
<!-- <h1>Users Table</h1> per qualche motivo compare sopra la barra di login/logout -->
    <table>
        <thead>
            <tr>
                <th width=250px align="center">Trainer</th>
                <th width=250px align="center">Email</th>
                <th width=250px align="center">Profilo</th>
                <th width=250px align="center">Disponibilità</th>   
                <th width=100px></th> 
                <tr>
                                            <td><br></td>
                                         </tr>
            </tr>
        </thead>
        <tbody>
            <?php
                
                $dbconn = pg_connect("host=localhost port=5432 dbname=GymGeniusASSI user=postgres password=password") 
                or die('Could not connect: ' . pg_last_error());

                if ($dbconn) {
                    session_start();
                    include 'templatelog.html'; 
                    $ruolo = 'Trainer';
                    $query = "SELECT * FROM utente WHERE ruolo = $1";
                    $result = pg_query_params($dbconn, $query, array($ruolo));
                    
                    
                    // Verifica se ci sono risultati
                    if (pg_num_rows($result) > 0) {
                        // Iterazione sui risultati della query
                        
                        while ($row = pg_fetch_assoc($result)) {
                            $emailAddress = $row["email"];
                            echo "<tr>
                                    <td>{$row['nome']}"; 

                                    // solo admin: eliminazione trainer 
                                    if ($_SESSION['ruolo']=='Admin') {
                                        echo '&nbsp;&nbsp;<a href="elimina_trainer.php?id='.$row['id'].'" type="button" class="btn btn-danger" target="_blank" onclick="return confermaEliminazione();">Elimina</a>';
                                    }
                                    echo "</td>
                                    <td><a href='mailto:".$emailAddress."'>$emailAddress</a></td>
                                    <td>
                                        <form action='vedi_profilo_trainer.php' method='post'>
                                        <input type='text' value={$row['id']} hidden id='id_trainer_profilo' name='id_trainer_profilo'>
                                        <button type='submit'>Vedi profilo</button>
                                        </form>
                                    </td>
                                
                               ";
                               $id=$row['id'];
                               $condition='true';
                               $q2="SELECT * FROM disp WHERE id_trainer=$1 and free=$2";
                               $r2 = pg_query_params($dbconn, $q2, array($id,$condition));
                               if (pg_num_rows($r2) > 0) {
                                    while ($row2 = pg_fetch_assoc($r2)){
                                        echo "</tr>
                                                <form action='prenota_appuntamento.php' method='post'>
                                                <tr>
                                                    <td><input type='text' value={$row2['id_trainer']} hidden id='id_trainer' name='id_trainer'></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <input type='text' readonly value={$row2['data_d']} id='data_app' name='data_app'>
                                                        
                                                    </td>";
                                        if($_SESSION['ruolo']=="User"){
                                            echo "
                                                    <td>
                                                        <button type='submit'>Prenota</button>
                                                    </td>
                                                    ";
                                        }
                                               
                                        echo"
                                                </tr>
                                              </form>
                                            "; 
                                    }
                                    echo "<tr>
                                            <td><br><br></td>
                                         </tr>";
                                    

                               } else {
                                    echo "<td>
                                            NESSUNA DISPONIBILITÀ
                                         </td>
                                         </tr>
                                         <tr>
                                            <td><br><br></td>
                                         </tr>
                                        "; 
                                }
                                
                               
                               
                        }
                        
                        
                            
                    } else {
                        echo "Nessun risultato trovato.";
                    }

                    // Chiusura della connessione
                    pg_close($dbconn);
                }else {
                    echo "Connessione al database non riuscita";
                }
            ?>
        </tbody>
    </table>

    
</body>
</html>