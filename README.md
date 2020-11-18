# Welcome !!! SORTIR.com
Bonjour

#Quelques précisions

#Organisation des différentes vues et controlleurs

Page connexion : url = http://localhost/projet/public/login

Usercontroller
@Route "/login"
user/login.html.twig

Page Accueil (hors connexion): url = http://localhost/projet/public

Defaultcontroller
@Route "/"
default/home.html.twig

Page Accueil (connecté) : url = http://localhost/projet/public/index

Sortiecontroller
@Route "/sortie"
sortie/list.html.twig

Page mon profil (modifier mon profil) : url = http://localhost/projet/public/profil

Usercontroller
@Route "/profil"
user/profil.html.twig

Page afficher mon profil (visualiser mon profil) : url = http://localhost/projet/public/monprofil

Usercontroller
@Route "/profil/monprofil"
user/monprofil.html.twig

Page créer une sortie : : url = http://localhost/projet/public/sortie/add

Sortiecontroller
@Route "/sortie/add"
sortie/add.html.twig

Page afficher une sortie : url = http://localhost/projet/public/sortie/id

Sortiecontroller
@Route "/sortie/{id}"
sortie/detail.html.twig

Page afficher une sortie : url = http://localhost/projet/public/sortie/edit

Sortiecontroller
@Route "/sortie/edit"
sortie/edit.html.twig

Page afficher une sortie : url = http://localhost/projet/public/sortie/delete

Sortiecontroller
@Route "/sortie/delete"
sortie/delete.html.twig

Gérer les villes ?

Gérer les sites ?
