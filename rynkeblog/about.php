<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>  
    <head>
        <title>About</title>
        <link rel="stylesheet" href="css/aboutstyle.css" type="text/css"  />
        <link rel="stylesheet" href="css/main.css" type="text/css" media="screen, projection" />
    </head>

    <body id="home">
    <?php include_once 'menu.php'; 
    require ('blogentityhandler.class.php');?>

    <div class="wrap">
        <div id="left">
            <br />
            <div id="about">        
    
		<h2>About the Blog</h2><br/><br/>
                    <h2>Videreutvikling av Blogg; Krav:</h2>
                    <p>
                     This is a blog created for a school project in web-application course.
                    </p>
                    <table>
                        <li>Det skal være mulig å kommentere innlegg. Kun registrerte bruker skal kunne gjøre dette, anonyme brukere kan kun lese.</li>
                        <li>Brukere må kunne registrere seg med nødvendig informasjon, passord for brukere lagres med md5 hash i databasen. Du bestemmer selv annen relevant informasjon som bør lagres for en bruker. Ved registrering skal det sendes epost til brukeren for bekreftelse på denne, bekreftelse er nødvendig før konto tas i bruk.</li>
                        <li>Ved glemt passord skal nytt passord kunne sendes pr epost til brukeren.</li>
                        <li>Innlegg bør kunne ha vedlegg av begrenset størrelse. Dette kan være bilder eller andre dokumenter. Vedleggene lagres i databasen og skal (som oftest) vises ved lesing av innlegget. Du kan selv begrense typen vedlegg som er mulig.</li>
                        <li>Presentasjon på startsiden viser alle (evt. et utvalg av alle) innlegg sortert på dato med antall kommentarer.</li>
                        <li>Eldre innlegg bør kunne aksesseres på månedsbasis, slik at det er lett å få opp innlegg for en aktuell måned, oversikten bør inneholde antall innlegg denne måneden, se f.eks. http://weblogs.asp.net/scottgu/default.aspx</li>
                        <li>Det bør være trefftellere på de ulike innleggene, denne oppdateres ved hver aksess og vises på web.</li>
                        <li>Det bør være mulig å søke på innleggenes emne og innhold for å finne det en er på jakt etter.</li>
                        <li>Eieren av bloggen bør kunne drive vedlikehold av bloggen og foreta operasjoner som sletting av upassende kommentarer og registrering av nye stikkord (tags).</li>
                    </table>
                    <p>   
                    Created by; Vitaly, Timur and Martin
                    </p>
            </div>
            <br />
        </div>
        
        <div id="right">
            <h2>Latest Entries</h2>
                <ul>
                    <li><a href="index.php">Lates post</a></li>			       
		</ul>     
                        
            <h2>Tags Cloud</h2>
                <div id="tagcloud">
                    <?php
                        include("tagcloud.php"); 
                    ?>
                </div>
                        
                <h2>Archive</h2>
                    <ul>
                        <li>
                             <?php
                                include('datetime.php');
			     ?>
                        </li>            
                    </ul>
                                       
                    <?php
                        include 'search.php';                                 
                    ?>
	</div>

        </div>  	
</body>
</html>
