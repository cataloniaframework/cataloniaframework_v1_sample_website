<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2013-02-11 00:15
 * Last Updater: Carles Mateo
 * Last Updated: 2014-01-01 20:23
 * Filename:     index_index_ca.php
 * Description:  View for index Controller index Action, language Catalan
 */

namespace CataloniaFramework;

?><html>
    <head>
    <?php require_once 'index_head.php'; ?>
    </head>
<body>
||*||[HEAD_TITLE_BLOCK]||*||
||*||[HEAD_NAVIGATION_BLOCK]||*||
<div class="body_page">
Benvinguts a la pàgina web de Catalonia Framework.<br />
Catalonia Framework és un marc de treball PHP, Programari Lliure.<br/>
<br />
La darrera versió de Catalonia Framework és la v.1.1.014 del 2014-01-11.<br />
<br />
Resum de funcionalitats:<br />
<ul>
    <li>Compatible amb PHP 5.3, 5.4, 5.5</li>
    <li>MVC</li>
    <li>Sistema de cache incorporat, a nivell de Controlador MVC, pot ser sobreescrit per les Action </li>
    <li>Sistema dinàmic que permet un nivell infinit de seccions vives dins de continguts catxejats, customitzats en temps real</li>
    <li>Multi-Idioma (planes in diferents llenguatges fàcilment)</li>
    <li>SEO multi-llenguatge nadiu</li>
    <li>Molt ràpid</li>
    <li>Molt fleixble</li>
    <li>Preparat per a servir continguts (com imatges, vídeo, Json/Ajax, Xml...)</li>
    <li>Molt fàcil d'aprendre</li>
    <li>Abstracció de la Base de Dades, suporta diferents motors de base de dades (MySql, PostgreSQL i Cassandra)</li>
    <li>No empra les Connexions a la Base de Dades fins que realment són usades</li>
    <li>Suporta Db Primària (Inserts), i Secundàries (Reads)</li>
    <li>Incorpora funcionalitat DbSharding per a treballar transparentment contra un Shard de Servidors de BDD (diferents motors suportats)</li>
    <li>Incorppora CQLSÍ - Cassandra Query Language Simple Interface (sense Thrift)</li>
    <li>Realment Flexible Form manager amb validació de camps i indicació dels errors</li>
    <li>Funcions SEO incloses per Seccions i url remaping</li>
    <li>Incloses Classes per a Format de Moneda/imports, dates, menús...</li>
    <li>Suporta diferents entorns (Development, PreProd/Staging, Production)</li>
    <li>Suport nadiu per a CDN, continguts estàtics</li>
    <li>Compatible amb servidors Linux, Mac, Unix, i windows</li>
    <li>Custom Exceptions i Views d'error customitzades</li>
    <li>Sistema de Templates integrat per a Views multi-llenguatge reusables (però podeu fer-ne servir d'altres com Smarty)</li>
    <li>Moltes classes són glueless, les podeu fer servir sense la resta del Framework</li>
</ul>
<br />
</div>
<br />
<?php require 'index_footer.php'; ?>
</body>
</html>