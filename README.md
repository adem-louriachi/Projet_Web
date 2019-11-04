# FreeNote by 4randoms

Nom de l'équipe : Les 4Randoms  
Paul Chabas paul-chabas@etu.univ-amu.fr  
Vincent Ferrer vincent.ferrer@etu.univ-amu.fr  
Adem Louriachi adem.louriachi@etu.univ-amu.fr  
Guillaume Piccina guillaume.piccina@etu.univ-amu.fr  

URL de l'index du site : https://freenote-4randoms.alwaysdata.net/  

Présentation du projet
----------------------
Ce projet a pour but de créer un réseau social d’un nouveau genre appelé FreeNote qui est fait pour communiquer, comme tout réseau social, à la différence que dans FreeNote, il n'est possible d'écrire qu'un ou deux mots dans un message qui fait lui-même partie d'une discussion.

Choix techniques  
----------------
Nous avons fait plusieurs choix techniques :  
  - Alwaysdata comme hébergeur car c'est un hébergeur fiable et performant  
  - MySQL pour gérer notre base de données
  - Le PHP pour avoir un site Web dynamique  
    Au sein même du PHP, nous avons fait certains choix techniques  
        - Utiliser le modèle MVC ainsi que la programmation orientée objet afin que notre application soit évolutive, modulaire et professionnelle  
        - L'utilisation de PDO plutôt que l'utilisation de mysqli pour gérer la base de donnée car PDO est plus sécurisé
        - Pour le cryptage des mots de passe, nous avons choisi le cryptage avec la fonction password_hash() avec pour algorithme de cryptage le PASSWORD_BCRYPT car cela nous permet d'avoir des mots de passe protegés.
  - Pour le CSS de notre site, nous avons utilisé Materialize pour que notre site soit parfaitement responsive  
  
  
La configuration logicielle  
---------------------------
|         | Mnimale | Recommandé |
|:-------:|:-------:|:----------:|
| Windows | Chrome 39.0 - Firefox 30.0 - Opera 57.0 - Internet Explorer 10 | Chrome 78.0 - Firefox 70.0.1 - Opera 64.0 - Microsoft Edge 44 |
|  Linux  | *Debian 6.0* - Firefox 16.0 - Chrome 38.0 - Opera 12.16 |  *Linux Ubuntu 18.04.3* - Chrome 78.0 - Firefox 70.0.1 - Opera 64.0 |
|  MAC OS | Chrome 41.0 - Firefox 30.0 - Safari 5.1 | Firefox 70.0.1 - Firefox 70.0.1 - Safari 13 - Opera 64.0 |

