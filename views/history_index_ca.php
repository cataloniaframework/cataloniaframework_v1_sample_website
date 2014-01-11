<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-11 14:01
 * Last Updater: Carles Mateo
 * Last Updated: 2014-01-11 14:05
 * Filename:     history_index_ca.php
 * Description:
 */

namespace CataloniaFramework;

?><html>
    <head>
    <?php require_once 'index_head.php'; ?>
    </head>
<body>
<div class="header-body">
    <div class="head_logo">
        <img src="/img/cataloniaframework-logo1-30pc-no_mg.png" />
    </div>
    <div class="head_title">
        <h1 id="site-name">History of Catalonia Framework</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>Va ser al mig de 2012 quan una Start up ben finançada a Silicon Valley em va contactar per a una oferta de feina.<br />
    Ells gestionarien el visat de treball per a treballar als Estats Units.<br />
    La posició era per a un BackEnd Senior, una mena de DevOps actual, capaç de gestionar el gran creixement de la companyia, havia de ser molt bo en desenvolupament i també en sistemes.<br />
    Els vaig comentar que jo era molt bo en desenvolupament i en arquitectura/sistemes, (normalment ocupant posicions com cap de desenvolupament i CTO) però no en ho era en desplegament massius a granges de servidors existents (jo emprava els meus propis sistemes via ssh però en aquells moments no usava Chef i Pupet i aquesta mena de programari d'orquestació).<br />
    Ells em van dir que no hi havia problema i per a testejar el meu nivell expert em van demanar d'escriure en PHP una restful API capaç  de parsejar paràmetres, fins i tot paràmetres no esperats.<br />
    Vaig desenvolupar un petit però precís Framework capaç de fer això. Era capaç de validar Strings, Numbers, dates, gestionar paràmetres repetits, la mancança de paràmetres obligatoris, validar contra un Array de valors acceptats o una expressió regular, controlar i limitar la llargada, sanititzar... molt més del que esperaven.<br />
    El cap d'operacions de la companyia va fer un Epic Fail i em va respondre em rebutjava la meva candidatura perquè ells volien algú amb experiència prèvia en desplegaments massius automàtics a milers de servidors, i com deia al meu CV no era el cas, sense ni tan sols revisar el meu codi.<br />
    Va ser un Epic Fail puix que jo els ho havia dit des del principi, així que em van fer perdre el temps.<br />
    Pot semblar impossible de creure però moltes companyies fan coses així i fins i tot pitjors, allunyant el talent per sempre!.<br />
<br />
    Jo estava molt satisfet amb els meus motors i sabia que serien útils.<br />
    Tinc experiència en motors de Forms: desenvolupant des que tenia 5 anys en diferents llenguatges, i els darrers anys he estat al càrrec del sistema de formularia de Privalia (usàvem el Framework de Zend però els seu component Form era massa limitat i no prou bo així que teníem el nostre), també he treballat amb el sistema de formularis de Drupal, de WordPress, Joomla, Magento i Frameworks com CodeIgniter, i llibreries de validació de camps, i sabia que cap feia tot el que el meu motor feia (alguns feien una part, però cap ho feia tot), així que vaig decidir treballar una mica més i vaig construir la classe Form, com una classe independent que podia afegir a tots els meus projectes.<br />
    A part de validar, la classe Form, permetia renderitzar l'HTML (tenint cura dels caracters especials com &lt;&gt; ' quan es pintava després d'un POST) però amb una flexibilitat total que no tenien els altres paquets, no condicionava la maquetació, i també retornava automàticament on eren els errors i ho marcava si el desenvolupador volia, així com permetia respondre a POST/GET de pàgina o validacions per JSon.<br />
<br />
    Vaig usar la classe Form en alguns dels meus projectes, com AfterStart, i vaig estar molt content amb els resultats.<br />
    El Form controlava la sortida d'errors, la renderització, la validació... <br />
    El vaig crear com una classes que es pot extendre així que es poden crear Data Objects per a tenir tants Forms reusables com es vulgui per a diferents funcions.<br />
    Així que em trobava usant la meva classe Form per als meus projectes, de manera molt exitosa, i un conjunt de les meves llibreries que anava usant de projecte en projecte.<br />
<br />
    Sóc molt bo trobant bugs, de fet he aconseguit algunes de les meves feines demostrant vulnerabilitats existents a CEOs.<br />
    En un moment donat vaig quedar tip de veure sempre els mateixos errors en un munt de llocs webs i de tant en tant en el codi dels meus propis equips, i vaig pensar que havia de fer alguna cosa al respecte.<br />
    El món es mereix millor programació. De fet tot el que fem necessita un munt d'amor per part nostra per a ser fet ben fen.<br />
    Vaig decidir escriure un Framework MVC que previndria aquests errors comuns i ajudaria a escriure webs molt ràpid, seo friendly, multi-idioma, de manera molt flexible i capaces d'escalar bé.<br />
    Volia afegir alguns dels meus trucs per a incrementar el rendiment, com cache incorporat, suport per a bases de dades secundàries, i també volia que l'actualització a les noves versions del Framework fossin molt molt fàcils.<br />
    Volia proporcionar una mica de la meva màgia, així per exemple un sistema de plantilles (Templates) capaç de tenir catxejada quasi tota la plana però mantenir dinàmiques les seccions dessitjades, de manera que es reduissin les consultes a la base de dades i la tasca del processador, però mantenint les parts importants vives sense haver d'usar JSon (Google indexa planes, no crides JSon refrescant divs) per a SEO. Vaig crear aquest motor el 1996, quan vaig crear el primer sistema de venda d'entrades per a esdeveniments (Ticketing) a Europe (A USA ja n'existia abans). Va ser un projecte molt reixit que vaig creat en C per a Linux per a Tick Tack Ticket (ara part de Ticketmaster).<br />
    Malgrat els meus dissenys inicials eren en C he estat emprant el meu patró en un llarg rang de llenguatges aquests anys: C++ per a windows, Visual Basic, ASP, Java, PHP... Si penses be l'algoritme el pots transportar a qualsevol llenguatge decent.<br />
    El vaig usar també en un dels meus projectes a l'asseguradora winterthur (ara axa) per a a judar el meu equip, que estava encallat, en aquells temps en que el rendiment impactava molt i els sistemes de templates eren massa rigids i lents.<br />
    La idea era que el Framework base seria petit però proporcionant aquestes sempre emprades funcionalitats essencials, sistemes de seguretat i funcionalitats molt potents.<br />
    <br />
    Frameworks com Zend i Symfony són durs de començar a treballar-hi, la corva d'aprenentatge és molt pronunciada, i com CTO o cap de desenvolupament mai he volgut que els meus equips gastin quatre mesos aprenent un Framework abans de ser productius.<br />
    Mai tenim temps per a això. Hem de produir resultats. I de vegades un líder ha de lidiar amb tota mena de desenvolupadors, des de Juniors a Seniors, especialment Juniors, i proporcionar resultats a negoci amb un calendari concret. Si els desenvolupadors poden començar a produir en dues hores, perquè no?.<br />
    Catalonia Framewok va nèixer per a començar a produir immediatament.<br />
    He vist un munt de projectes començant amb un programari Open Source i corrent bé molt al principi però tenint malsons de rendiment and impossibilitat per a escalar més tard quan una mica de tràfic començava a arribar al lloc web (com Groupalia amb Magento) o patint un munt de problemes perquè van canviar el nucli (core) del Framework/CMS per tal de fer allò que volien (i no sabien com o no podien fer amb mòduls), i les migracions posteriors són un infern... així que Catalonia Framework proporcona mecanismes simples per a afergir el vostre codi comú a la carpeta init/ i usar controllers + models + views per a la resta.<br />
    Desenvolupar amb Catalonia Framework és simplment fàcil, no cal aprendre hooks, etc... us podeu concentrar a produir codi per al negoci.<br />
    I totés simplement PHP. Sense sub-llenguatges per a les Views, etc...<br />
    La idea és proporciona Llibertat. Així no hi ha gaire estructures predefinides, ni limitacions, tot és simplement fàcil. El sistema de Templates és basat en PHP, es proporcionen paràmetres sanititzats però $_POST i $_GET es mantenen sense alterar, es defineixes constants per a permetre el seu ús arreu, els models són carregats sota demanda per a estalviar memòria, només les traduccions requerides són carregades... un petit ràpid Framework. :)<br />
<br />
    Així que vaig ensamblar el Framework jo sol i vaig reescriure algunes de les meves webs, que empraven les meves llibreries, per a usar el Framework.<br />
    Menjar el menjar del teu gos ("<a href="http://en.wikipedia.org/wiki/Eating_your_own_dog_food" target="_blank">Eating your own dog food</a>") és genial perquè et força a ser molt honest: si el teu producte és dolent odiaràs usar-lo, però si és bo te n'adonaràs també. I si uses les teves creacions t'adonaràs que manca o que pot ser implementat per a proporcionar-te les funcionalitats que dessitges.<br />
    Penso que la gent ha d'usar les seves pròpies creacions. Si el banquer inverteix en els productes que ven, si l'enginyer condueix el cotxe que ha dissenyat, si McDonnalds menja les seves hamburgueses cada dia, si els polítics viuen sota les lleis que ells han creat (o les necessàries que han deixat de creat)... el món seria un lloc millor.<br />
    Perquè ells estarien frustrats amb la seva pròpia brossa i dessitjabalement millorarien.<br />
    Vaig enviar el Framework als meus amics propers més Seniors en desenvolupament i vaig rebre molt bon feedback. Alguns d'ells estaven impressionats.<br />
<br />
    Així que tot va començar amb la classe Form.<br />
    Després la vam usar a ECManaged, el projecte Cloud (Jo estava al capdavant com cap de desenvolupament/Chief Architect) per a ensamblar dinàmicament forms d'acord a diferents configuracions a les bases de dades.<br />
<br />
    Volia mantenir el Framework compatible amb PHP 5.3 ja que molts hostings web i servidors encara l'usen i perquè <strong>les distribucions Ubuntu LTS</strong> es basaven en PHP 5.3. Això és realment important sota el punt de vista de manteniment i dels SysAdmins.<br />
<br />
    Després d'usar i testejar el meu Framework durant un temps, el vaig enviar de manera més general als meus amics per a que el revisessin. van començar a usar-lo en els seus projectes, i una mica més tard, al Febrer de 2013, la plana web va nèixer i el Framework fou alliberat com Open Source.<br />
<br />
    El codi és devenvolupat principalment per mi, Carles Mateo, amb algunes contribucions. A mida que més gent l'utilitzi, més contribuidors s'afegiran però vull mantenir el projecte controlat per a assegurar la qualitat del codi.<br />
    De moment mantinc un Git per a desenvolupament i un Git separat per a versions estables.<br />
    Alguns dels meus amics Sysadmins m'han preguntat perquè ho faig així, enlloc de tenir branques i releases al mateix repo.<br />
    Ho faig així per a fer més fàcil per a qui usa el Framework mergear amb les versions estables des de Producció, i evitar desenvolupaments parcials que la gent puja al repo, que podrien trencar els webs.<br />
    Simplement feu pull del repo estable i només baixaran version estables d'allí. Un repo per a la versió 1, un altre per a la v. 2...<br />
    El desenvolupadors seguiran desenvolupant al nostre repo de development i el codi serà alliberat al repo git estable quan estigui llest.<br />
    Si algú està treballant en local amb el seu ordinador construint un projecte amb la versió 1.1.010 i la v. 1.1.011 és alliberada, només haurà de fer pull i mergear els pocs arxius customitzables. Fàcil. Sense drames.<br />
    <br />
    Encara segueixo integrant funcionalitat de les meves llibreries al Framework alhora que avançant en paral·lel amb les noves necessitats.<br />
    <p/>
    <img src="/img/manual/cataloniaframework-working-on-bars-with-wifi.png" alt="Cert codi ha estat desenvolupat a bars :)" title="Cert codi ha estat desenvolupat a bars :)" />
<br />
</div>
<?php require 'index_footer.php'; ?>
</body>
</html>