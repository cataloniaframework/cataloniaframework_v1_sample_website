<?php

/**
 * Creator:      Carles Mateo
 * Date Created: 2014-01-06 06:23
 * Last Updater: Carles Mateo
 * Last Updated: 2014-01-09 18:58
 * Filename:     history_index_en.php
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
<p>It was the in the middle of 2012 when a well funded Start up located in Silicon Valley contacted me for a job offer.<br />
    They would handle the Visa for working in The States.<br />
    The position was for a Senior BackEnd, a kinda of nowadays DevOps, able to handle the huge growth of the company, had to be very good in development and also in systems.<br />
    I told them that I was very strong in Development and in Architecture/Systems, (normally occupying positions as Head of Development and CTO) but not in massive deployments to existing farms of servers (I used my own system via ssh but at that time I was not using Chef and Pupet and that kind of orchestration stuff).<br />
    They told me that was Ok and as a test of my expertise they requested me to write a PHP restful API able to parse parameters, even unexpected parameters.<br />
    I developed a small but fine framework able to do that. It was able to validate strings, numbers, dates, handle repeated parameters, missing mandatory ones, validate against an array of accepted values or regexp, limit the lengths, sanitize... much more than they expected.<br />
    The head of operations on the company did an epic fail and replied to me that he rejects me because they wanted someone that had previous background experience in massive automated deployments to thousands of servers, and as seen in my CV that was not the case, without even reviewing my code.<br />
    That was an epic fail because I told them from the beginning, so they wasted my time.<br />
    It could appear impossible to believe but many companies do that and even worse epic fails, moving away talent forever!.<br />
<br />
    I was very satisfied with my Engine and I knew it would be very useful.<br />
    I have a background in Form Engines: programming from the 5 years in different languages and in the recent past I had been in charge of the Privalia's form system (we used Zend Framework 1 but its Form was too limited and not good enough so we wrote our own), and I have worked with Drupal's, WordPress', Joomla's, Magento's and Frameworks like CodeIgniter, and fields validation libraries, and I knew that no one was doing all what my Engine was able to (some did a part, but none was doing everything), so I decided to work a bit more, and I build the class Form as a stand alone working class that I can use in my projects.<br />
    In addition to validate input, the Form class, allowed to render the HTML (also taking care or special characters like &gt;&lt; and ' when showing back after POST) but with a total flexibility that the other softwares lack, was not conditioning the maquetation, and it was returning automatically where the errors were and automatically highlighted them if the developer wanted it, as well as being able to reply to POST/GET with complete page refresh or JSon.<br />
<br />
    I used the class Form in some of my web projects, like AfterStart, and I was really happy with the results.<br />
    The Form was controlling the errors output, the render, the validation... <br />
    I created it extendable so DO can be created in order to have as many as wanted reusable Forms for different purposes.<br />
    So I was using Form Class for my projects very successfully, and a set of my own libraries that I was reusing in one project and another.<br />
<br />
    I'm very good finding bugs, and in fact I've got some of my jobs by demonstrating existing vulnerabilities to CEOs.<br />
    At certain point I became really tired of seeing the same errors in a lot of websites and sometimes in my own Team's code, and I thought that I had to do something about it.<br />
    The world deserves better coding. In fact every thing we do requires a lot of love from our part to be done right.<br />
    I decided to write a MVC Framework that would prevent those common errors and help to write webs very fast, seo friendly, multi-language, in a flexible way, and able to Scale well.<br />
    I wanted to add some tricks to improve performance, like built-in cache, support for secondaries databases, and also wanted that the upgrade to the newer versions of the Framework would be very very easy.<br />
    I wanted to provide some of my magic, so for example a Template system able to cache most of the page but keep live the sections I want, so reducing a lot of queries and job, but keeping the important live without using JSon (Google index pages, not JSon calls refreshing divs) for SEO. I created that Engine in 1996, when I created the first Ticketing System for events in Europe (in USA there existed one before). It was a very successful project that I created in C for Linux for Tick Tack Ticket (now part of Ticketmaster).<br />
    Despite my initial designs were in C I have been using my pattern in a long range of languages in those years: C++ for windows, Visual Basic, ASP, Java, PHP... If you thing well the algorithm you can transport to any decent language.<br />
    I used also in one of my projects in winterthur insurance (now axa) to help my team, thas was stucked, those days when performance was an issue and template systems were too rigid and slow.<br />
    The idea was that the base Framework would be small but bringing that always-used essential core features, security measures and some very cool features.<br />
    <br />
    Frameworks like Zend and Symfony are hard to begin with, the learning curve is very pronounced, and as CTO or Head of Development I never wanted my teams to spend four months learning a Framework before being productive.<br />
    We never have time for that. We have to produce results. And sometimes one Lead has to deal with all range of developers, from Junior to Senior, specially Juniors, and provide results to business within a certain schedule. If they are able to start producing in just two hours, why not?.<br />
    Catalonia Framewok was born to start producing immediately.<br />
    I've seen a lot of projects starting with an Open Source Software and running fine in the early stage and having nightmares about performance and impossibilities to Scale later when a bit of traffic began to hit the site (like Groupalia with Magento) or having a lot of problems because they changed the core of the Framework/CMS in order to do what they want (because they didn't know how to do it or was not possible with modules), and the later migrations are a hell... so the Framework provides simple mechanisms to add your common code in the init/ folder and use controllers + models + views for the rest.<br />
    Developing with Catalonia Framework is just easy, no need to learn hooks, etc... concentrate into producing the code for your business.<br />
    And everything is just PHP. No new sub-languages for the Views, etc...<br />
    The idea is to provide Freedom. So there are no many built-in structures, limitations, everything is just easy. The Template System is PHP based, sanitized params are provided but $_POST and $_GET remain untouched, constants are defined to allow the consumption everywhere, the models are loaded on demand to save memory, only required translations are loaded... a tiny fast Framework. :)<br />
<br />
    So I assembled the Framework alone and rewrote some webs from my old libraries to the Framework.<br />
    "<a href="http://en.wikipedia.org/wiki/Eating_your_own_dog_food" target="_blank">Eating your own dog food</a>" is cool because force you to be very honest: if your product is just bad you will hate using it, but if is good will you'll also notice. And if you use your creations you will notice what is missing or what can be improved to bring you that feature you want.<br />
    I really think people should use their creations. If the banker invest in the products he sell, if the Enginner drives the car he has designed, if McDonnalds eats his burgers everyday, if the politicians live under the laws they have created (or without the ones they missed creating)... the world would be much better.<br />
    Because they would became frustrated over their own shit and hopefully improve.<br />
    I sent my Framework to my Senior close friends in development, and I got a wonderful feedback. Some of them were astonished.<br />
<br />
    So everything started with the Form Class.<br />
    Later we used the Form class in ECManaged, the Cloud project (I was in charge as Head of Development/Chief Architect) to assemble dynamically forms according to different configurations in the databases.<br />
<br />
    I wanted to keep the Framework compatible with PHP 5.3 because many web hostings and servers still use it and because <strong>Ubuntu LTS distributions</strong> were based on PHP 5.3. That is really important for maintenance and SysAdmins view point.<br />
<br />
    After successfully using and testing my Framework for a while, I sent it generally to my friends for a review. They started to use it in their projects, and a bit later, in February 2013, the webpage was born and the Framework was released as Open Source.<br />
<br />
    The code is developed by me, Carles Mateo, with some contributions. As more people will be using it, more contributors will come but I want to keep the project controlled to ensure the quality of code.<br />
    By the moment I keep a Git for Development and a separate Git for the Stable releases.<br />
    Some of my Sysadmin friends asked me why I do that, instead of having branches and releases in the same repo.<br />
    I do that to make it easy for people merging with the Stable release from Production, and to avoid partial developments from people submitted to the repo, that can break the thing.<br />
    Just pull from the Stable repo and only Stable versions will come from there. One repo for version 1, another for version 2...<br />
    Developers will keep working in our Development repo and code will be released to the Stable git repo when is ready.<br />
    If someone is working local with its computer building a project from the version 1.1.010 and 1.1.011 is released, he only will have to pull and merge the few customized files. Easy. No drama.<br />
    <br />
    I'm still integrating functionality from my libraries to the Framework and a the same time advancing wiht the development of the new needs.<br />
    <p/>
    <img src="/img/manual/cataloniaframework-working-on-bars-with-wifi.png" alt="Some code has been developed in bars :)" title="Some code has been developed in bars :)" />
<br />
</div>
<?php require 'index_footer.php'; ?>
</body>
</html>