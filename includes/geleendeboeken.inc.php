<?php
if(isset($_SESSION['role'])){
    if($_SESSION['role'] != "user"){
        header('location: index.php?page=NoAccess');
        die();
    }
}else{
    header('location: index.php?page=NoAccess');
    die();
}
?>

<h1>Geleende Boeken</h1>
<table id="boeken">
    <tr>
        <th>Naam</th>
        <th>Schrijver</th>
        <th>Genre</th>
        <th>ISBN-nummer</th>
        <th>Taal</th>
        <th>Aantal pagina's</th>
        <th>Aantal exemplaren</th>
        <th>Geleende boeken</th>
    </tr>
    <td>Eclipse</td>
    <td>Stephenie Meyer</td>
    <td>Fantasy</td>
    <td>06792</td>
    <td>Engels</td>
    <td>629</td>
    <td>50</td>
    <td><button type="submit" class="btn-lenen">Terug geven</button></td>
    </tr>
    <tr>
        <td>Hygge</td>
        <td>Meik Wiking</td>
        <td>Lifestyle</td>
        <td>30371</td>
        <td>Engels</td>
        <td>288</td>
        <td>50</td>
        <td><button type="submit" class="btn-lenen">Terug geven</button></td>
    </tr>
    <tr>
        <td>Sapiens</td>
        <td>Yuval Noah</td>
        <td>Geschiedenis</td>
        <td>231609</td>
        <td>Engels</td>
        <td>512</td>
        <td>50</td>
        <td><button type="submit" class="btn-lenen">Terug geven</button></td>

    </tr>
    <tr>
        <td>Ikigai</td>
        <td>Francesc Miralles</td>
        <td>Zelfhulp</td>
        <td>313072</td>
        <td>Japans</td>
        <td>208</td>
        <td>50</td>
        <td><button type="submit" class="btn-lenen">Terug geven</button></td>
    </tr>
    <tr>
        <td>Gone</td>
        <td>Michael Grant</td>
        <td>Young Adult</td>
        <td>144878</td>
        <td>Engels</td>
        <td>576</td>
        <td>50</td>
        <td><button type="submit" class="btn-lenen">Terug geven</button></td>
    </tr>
    <tr>
        <td>Zoo</td>
        <td>James Patterson</td>
        <td>Thriller</td>
        <td>21114</td>
        <td>Engels</td>
        <td>416</td>
        <td>50</td>
        <td><button type="submit" class="btn-lenen">Terug geven</button></td>
    </tr>
</table>
