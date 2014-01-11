<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-09-26 14:38
 * Last Updater:
 * Last Updated:
 * Filename:     manual_v2_url_mechanics_en.php
 * Description:
 */

namespace CataloniaFramework;

$s_manual_prefix = Section::getSectionURL('manual', true);

?><html>
    <head>
    <?php require_once VIEWS_ROOT.'index_head.php'; ?>
    </head>
<body>
<div class="header-body">
    <div class="head_logo">
        <img src="/img/cataloniaframework-logo1-30pc-no_mg.png" />
    </div>
    <div class="head_title">
        <h1 id="site-name">Manual - mecànica de les URL</h1>
    </div>
</div>
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
<p>El Framework està pensat per a ser molt flexible i permetre desenvolupar molt ràpid, per a això permet diverses maneres de mapejar URLs.</p>
<h2>Un arxiu al disc</h2>
<p>Com hem discutit a la secció <a href="<?php echo $s_manual_prefix.'v1/getting_started'; ?>">getting started</a> l'arxiu .htaccess us permet afegir a la carpeta www/ i serà servit amb normalitat, així que la primera via per a afegir contingut és simplement pujar-lo al sistema d'arxius (a la carpeta www/). Per exemple sitemap.xml pot ser simplement copiat l'arrel del servidor web</p>
<h2>Url mapper</h2>
<p>Si no necessiteu suport multi-llenguatge per a una url, per exemple, voleu servir el mateix contingut a /humans.txt per a tots els llenguatges podeu mapejar aquesta url per a ser gestionada pel framework i ser llegida d'algun altre arxiu al sistema d'arxius.</p>
<p>Editeu init/commonrequests.class.php i aquestes línies al mètode registerURLS:</p>
<pre>
Navigation::addURL('humans.txt', '/mnt/unaltreindretaldisc/humans.txt', Navigation::ACTION_REQUIRE_FILE,
                   ControllerBase::RESPONSE_TEXT, ControllerBase::CACHE_NO_CACHE);
</pre>
<p>ControllerBase::CACHE_NO_CACHE especifica que les capceleres seran enviades de manera que el navegador del client no catxegi el resultat.</p>
<p>Podeu servir arxius binaris, JSON, etc... simplement useu la constant ControllerBase::RESPONSE_JSON, ControllerBase::RESPONSE_TEXT o ControllerBase::RESPONSE_TEXTHTML...</p>
<p>Podeu especificar l'arxiu per a ser recuperat d'un altre indret del disc amb Navigation::ACTION_REQUIRE_FILE, però podeu fer que sigui una funció la que s'executi, per exemple:</p>
<pre>
Navigation::addURL('humans.txt', 'send_humans_file', Navigation::ACTION_CALL_FUNCTION,
                   ControllerBase::RESPONSE_TEXT, ControllerBase::CACHE_NO_CACHE);
</pre>
<p>Així en el darrer cas la funció "send_humans_file()" serà cridada quan l'arxiu humans.txt sigui cridat.</p>
<p>Si curl és actiu Navigation::ACTION_REQUIRE_URL pot ser emprat i el Framework agafarà la url especificada al segon paràmetre.</p>

<h2>MVC /controller/action i l'estructura de paràmeters</h2>
<p>Com s'ha indicat el Catalonia Framework mira d'ajudar a desenvolupar molt ràpid, així que es proveix un sistema per defecte per a carregar Controllers fàcilment.</p>
<p>Si teniu un Controller anomenat Forums i una Action anomenada actionListForums (la paraula precedent <strong>action</strong> a actionListForums és necessària) podeu cridar-lo des de la web així:</p>
<pre>http://www.cataloniaframework.com/ca/forums/listforums</pre>
<p>Així de simple.</p>
<p>Si crideu http://www.cataloniaframework.com/ca/forums llavors s'intentarà carregar Forums::indexAction.
    S'espera que proporcioneu un mètode indexAction per a tots els vostres Controllers.</p>
<p>Si crideu:</p>
    <pre>http://www.cataloniaframework.com/ca/forums/listforums/order/asc/newer_than/2013</pre>
    <p>Or en el cas que opereu en el mode no multi-llenguatge:</p>
    <pre>http://www.cataloniaframework.com/forums/listforums/order/asc/newer_than/2013</pre>
    <p>Llavors Forums::listForums will serà cridat i se li proveirà de $st_params que és un array com:</p>
    <pre>
Array( 0 => 'order',
       1 => 'asc',
       2 => 'newer_than',
       3 => '2013')</pre>
    <p>De cara a fer encara més fàcil treballar amb paràmetres un altre array serà proporcionat al Controller, és $st_params_url que és un array en parells com:</p>
    <pre>
Array( 'order' => 'asc',
        'newer_than' => '2013);
    </pre>
    <p>Si us plau considereu que els noms dels Controllers són sanititzats amb l'expressió regular a Strings::getSanitizedControllerName($s_name):</p>
    <pre>$s_sanitized= preg_replace('/([^a-z0-9])/', '', $s_name);</pre>
    <p>Les Array injections als paràmetres també són remogudes, així només Strings seran passades al Controller</p>
<p>Així doncs una crida usual a l'Action del Controller és com:</p>
    <pre>public function actionIndex($s_url = '', $st_params = Array(), $st_params_url = Array(), $o_db = null) {</pre>
    <p>Si el Controller no existeix una Exception serà llençada i capturada a index.php i una plana d'error es mostrarà.<br />
        Una View per defecte és proporcionada <strong>views/errors/errorgeneric.php</strong> , i tots els errors poden ser customitzats.</p>
    <img src="/img/manual/cataloniaframework-default-error-10-controller-or-action-not-found.png" border="1" /><br />
<h2>Definir Sections</h2>
<p>El Framework proporciona una manera addicional per a tractar amb Urls. Normalment totes les webs tenen seccions, i han de ser
    enllanced des de altres punts de la web. I és fàcil trencar aquests enllaços amb el canvi de nom d'una plana (per exemple per motius SEO).</p>
    <p>Per a solventar aquest problema el Frameworks ofereix un mecanisme Section.
        A partir de la classe Section podeu enregistrar una secció, i demanar la url d'aquesta secció més tard, i la rebreu independentment del llenguatge de l'usuari.</p>
<p>Això es fa a <strong>commonrequests.class.php</strong>, al mètode:</p>
    <pre>public static function registerSections($o_db = null) {</pre>
    <p>Per a definir una secció <i>manual</i>, que té la mateixa adreça URL per a tots els llenguatges al vostre lloc web farieu:</p>
    <pre>Section::registerSection('manual', $s_prefix.'manual', 'Manual', 'Index');</pre>
    <p>Així definirieu una Section identificada per '<i>manual</i>', que respondria amb /[LANG]/manual o /manual depenent de si el multi-llenguatge és activat, i cridaria la classe Manual i mètode Index (actionIndex)</p>
    <p>Si voleu usar diferent adreces URLs, per SEO, per als diferents llenguatges per a la secció <i>download</i> procedirieu així:</p>
    <pre>Section::registerSection('download', $s_prefix.t('seo_url_download'), 'Download', 'Index');</pre>
    <p>A la carpeta translations/ disposeu d'arxius de traducció i la clau (key) 'seo_url_download'. A cada arxiu d'idioma disposeu d'un valor per al llenguatge.</p>
    <p>Les Sections poden ser associades als objectes Menu per a crear menus, com a la DemoApp.</p>
<br />
<a href="<?php echo $s_manual_prefix; ?>">Back to Main Manual page</a><br />

</div>
<?php require VIEWS_ROOT.'index_footer.php'; ?>
</body>
</html>