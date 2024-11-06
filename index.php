<?php
include("database.php");

if(@$conn){
    echo "--- Connected ---" . "<br>";
} else {
    echo "!!! Disconected !!!" . "<br>";
}

// Verifica se o formulário foi enviado
if (isset($_GET["TeamName"]) && isset($_GET["Team"]) && isset($_GET["Player1"]) && isset($_GET["Player2"])) {
    $teamName = $_GET["TeamName"];
    $team = $_GET["Team"];
    $player1 = $_GET["Player1"];
    $player2 = $_GET["Player2"];

    // Insere os dados no banco de dados
    $sql = "INSERT INTO equipas (TN, TT, TP1, TP2) VALUES ('$teamName', '$team', '$player1', '$player2')";
    
    /*
    if ($conn->query($sql) === TRUE) {
        echo "Novo registro inserido com sucesso!";
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
    */
}

// Consulta as equipes já selecionadas no banco de dados
$selected_teams_query = "SELECT TT FROM equipas";
$result = $conn->query($selected_teams_query);

// Cria um array com as equipes selecionadas
$selected_teams = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $selected_teams[] = $row['TT'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="shortcut icon" href="assets/Favicon.png" type="image/x-icon">
    <title>Bootcamp</title>
</head>
<body>
    <main>
        <video autoplay loop muted playsinline class="bg-video">
            <source src="assets/EA SPORTS FC 24 _ Official Announce Trailer.mp4" type="video/mp4">
            Seu navegador não suporta o vídeo
        </video>
        <div class="container">
            <h2>Inscreva-Se!</h2>
            <form action="index.php" method="get">
                <div class="team_name name_team">
                    <label for="Teams">Escolha um nome para sua equipa!</label>
                    <input type="text" name="TeamName" placeholder="Nome da equipa...." required>
                </div>
                
                <div class="select_team name_team">
                    <div>
                        <label for="Teams">Selecione o seu time!</label>
                    </div>
                    <div>
                        <select name="Team" id="Teams" required>
                            <option value="">Escolha um time</option>
                            <?php
                            // Array de todas as equipes possíveis
                            $all_teams = ["Ajax", "Anderlecht", "Arsenal", "Aston Villa", "Atlético de Madrid", "Benfica", "Borussia Dortmund", 
                                          "Borussia Mönchengladbach", "Braga", "Brentford", "Brighton", "Burnley", "Celtic", "Chelsea", 
                                          "Crystal Palace", "Eintracht Frankfurt", "Everton", "Feyenoord", "Fulham", "Galatasaray", 
                                          "Inter de Milão", "Juventus", "Lazio", "Leeds United", "Leicester City", "Liverpool", "Lyon", 
                                          "Manchester City", "Manchester United", "Marselha", "Milan", "Mônaco", "Napoli", "Newcastle United", 
                                          "Nottingham Forest", "Olympiakos", "Paris Saint-Germain (PSG)", "Porto", "PSV Eindhoven", 
                                          "Real Betis", "Real Madrid", "Roma", "Schalke 04", "Sevilha", "Sporting CP", "Tottenham Hotspur", 
                                          "Union Berlin", "Valencia", "Villarreal", "West Ham United", "Wolverhampton Wanderers"];
                            
                            // Exibe apenas as equipes que ainda não foram escolhidas
                            foreach ($all_teams as $team) {
                                if (!in_array($team, $selected_teams)) {
                                    echo "<option value=\"$team\">$team</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
                <div class="team">
                    <h3>Nome dos participantes</h3>
                </div>
                <div class="name_team input_name">
                    <input type="text" name="Player1" placeholder="Nome do primeiro jogador" required>
                    <input type="text" name="Player2" placeholder="Nome do segundo jogador" required>
                </div>
                <div class="Start_btn">
                    <button type="submit">Começar!</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>

<?php
$conn->close();
?>
