                                                                            La sécurité des applications web

En matière de sécurité web, il existe 3 failles majeures : L'injection SQL, XSS (cross-site scripting), CSRF (cross-site request forgery)



                                                                                    1 L'injection sql

L'injection sql est un groupe de méthodes d'exploitation de faille de sécurité d'une application interagissant avec une base de données. Elle permet d'injecter dans la requête SQL en cours un morceau de requête non prévu par le système et pouvant en compromettre la sécurité.

Il existe plusieurs types d'injection SQL :

La méthode blind based (associée à sa cousine la time based), qui permet de détourner la requête SQL en cours sur le système et d'injecter des morceaux qui vont retourner caractère par caractère ce que l'attaquant cherche à extraire de la base de données. La méthode blind based, ainsi que la time based, se basent sur la réponse du serveur . La time based a pour seule différence qu'elle se base sur le temps de réponse du serveur plutôt que sur la réponse en elle-même.

La méthode error based, qui permet de détourner la requête SQL en cours sur le système et d'injecter des morceaux qui vont retourner champ par champ ce que l'on cherche à extraire de la base de données. Cette méthode profite d'une faiblesse des systèmes de base de données permettant de détourner un message d'erreur généré par le système de base de données et préalablement volontairement provoquée par l'injection SQL pour lui faire retourner une valeur précise récupérée en base de données.

La méthode union based, qui permet de détourner la requête SQL en cours sur le système et d'injecter des morceaux qui vont retourner un ensemble de données directement extraites de la base de données. Cette méthode profite de certaines méthodes afin de détourner entièrement le retour de la requête SQL d'origine afin de lui faire retourner en une seule requête un important volume de données, directement récupéré en base de données. Dans ses exemples les plus violents, il est possible de récupérer des tables entières de base de données en une ou deux requêtes, même si en général cette méthode retourne entre 10 et 100 lignes de la base de données par requête SQL détournée.

La méthode Stacked queries, la plus dangereuse de toutes. Profitant d'une erreur de configuration du serveur de base de données, cette méthode permet d'exécuter n'importe quelle requête SQL sur le système ciblé, ce qui ne se limite pas seulement à récupérer des données comme les 3 précédentes. En effet, quand ce type de requête n'est pas désactivé, il suffit d'injecter une autre requête SQL, et elle sera exécutée sans problème, qu'elle aille chercher des données, ou en modifier directement dans la base de données.




                                                                                2 XSS (cross-site scripting)

Le cross-site scripting (abrégé XSS) est un type de faille de sécurité des sites web permettant d'injecter du contenu dans une page, provoquant ainsi des actions sur les navigateurs web visitant la page. Les possibilités des XSS sont très larges puisque l'attaquant peut utiliser tous les langages pris en charge par le navigateur (JavaScript, Java...) et de nouvelles possibilités sont régulièrement découvertes notamment avec l'arrivée de nouvelles technologies comme HTML5. Il est par exemple possible de rediriger vers un autre site pour de l'hameçonnage ou encore de voler la session en récupérant les cookies.

Le principe est d'injecter des données arbitraires dans un site web, par exemple en déposant un message dans un forum, ou par des paramètres d'URL. Si ces données arrivent telles quelles dans la page web transmise au navigateur (par les paramètres d'URL, un message posté…) sans avoir été vérifiées, alors il existe une faille : on peut s'en servir pour faire exécuter du code malveillant en langage de script (du JavaScript le plus souvent) par le navigateur web qui consulte cette page.

L'exploitation d'une faille de type XSS permettrait à un intrus de réaliser les opérations suivantes :
    Redirection (parfois de manière transparente) de l'utilisateur (souvent dans un but d'hameçonnage)
    Vol d'informations, par exemple sessions et cookies.
    Actions sur le site faillible, à l'insu de la victime et sous son identité (envoi de messages, suppression de donnée)
    Rendre la lecture d'une page difficile (boucle infinie d'alertes par exemple).


En PHP les solutions sont :
utiliser la fonction htmlspecialchars()​ qui filtre les '<' et '>' (
utiliser la fonction htmlentities()​ qui est identique à htmlspecialchars()​ sauf qu'elle filtre tous les caractères équivalents au codage HTML ou JavaScript.


                                    
                                    
                                                                            CSRF (cross-site request forgery)


n sécurité des systèmes d'information, le cross-site request forgery, abrégé CSRF (parfois prononcé sea-surf en anglais) ou XSRF, est un type de vulnérabilité des services d'authentification web.

L’objet de cette attaque est de transmettre à un utilisateur authentifié une requête HTTP falsifiée qui pointe sur une action interne au site, afin qu'il l'exécute sans en avoir conscience et en utilisant ses propres droits. L’utilisateur devient donc complice d’une attaque sans même s'en rendre compte. L'attaque étant actionnée par l'utilisateur, un grand nombre de systèmes d'authentification sont contournés.

Les caractéristiques du CSRF sont un type d'attaque qui :

    Implique un site qui repose sur l'authentification globale d'un utilisateur ;
    Exploite cette confiance dans l'authentification pour autoriser des actions implicitement ;
    Envoie des requêtes HTTP à l'insu de l'utilisateur qui est dupé pour déclencher ces actions.

Pour résumer, les sites sensibles au CSRF sont ceux qui acceptent les actions sur le simple fait de l'authentification à un instant donné de l'utilisateur et non sur une autorisation explicite de l'utilisateur pour une action donnée.

Prévention :
    Demander des confirmations à l'utilisateur pour les actions critiques, au risque d'alourdir l'enchaînement des formulaires.
    
    Demander une confirmation de l'ancien mot de passe à l'utilisateur pour changer celui-ci ou changer l'adresse mail du compte.
    
    Eviter d'utiliser des requêtes HTTP GET pour effectuer des actions : cette technique va naturellement éliminer des attaques simples basées sur les images, mais laissera passer les attaques fondées sur JavaScript, lesquelles sont capables très simplement de lancer des requêtes HTTP POST.
    
    Effectuer une vérification du référent dans les pages sensibles : connaître la provenance du client permet de sécuriser ce genre d'attaques. Ceci consiste à bloquer la requête du client si la valeur de son référent est différente de la page d'où il doit théoriquement provenir.


