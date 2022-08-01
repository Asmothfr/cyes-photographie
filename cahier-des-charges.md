
Cahier des charges :

*Titre du site*
Nom du photographe=> /Bidule/ photographie

*Description du site et fonctionnalité*
- Site vitrine pour un photographe.
  
Fonctionnalité à destionation de l'utilisateur:
- contacter le photographe via un formulaire de contact.

Fonctionnalité à destionation de l'admin :
- Se connecter.
- créer de nouvelle catégorie.
- charger/modifier/supprimer des photos dans le site.
- Charger une photo de son choix pour le background de la page d'acceuil.
- Mettre à jour 



*Nombre de page et leur description*
Une page d'acceuil:
- avec une photo de fond qui peut être changé par l'admin. Format 16/9 ? Contrainte/message d'avertissement.
- barre de navigation transparente qui mène vers:
- - La gallerie photo. Contient toutes les catégories et photo. Sur fond gris neutre. Trouver   effet de transition entre les photos ?
- - Une page à propos. Présentation du photographe.
- - La page de contact. Formulaire de contact, qui envoie un email vers la page admin.(via db avec option lu/non lu).
- - (Idée) Une page info, qui permettrait de suivre les actualités du photographe. Comme ses  prochaines expos ou projet.
    En cas d'expo, une carte qui indique le lieu de l'exposition.
- - Un dossier Admin, caché, disponible uniquement avec le bon url.
    Qui comprend un drag and drop pour les photos et un formulaire pour entrer la photo dans la database.
    Une option qui permet de supprimer une photo.
    Pouvoir modifier une photo.
    Une option qui permet de mettre à jour le contenu des pages À propos, contact et info.
    Qui permet de choisir la photo à mettre en background pour la page de présentation du site.

*DATABASE*
- Une table Admin:
- Contient le pseudo et le mot de passe de l'admin.
- Une table catégorie.
- Une table photo. key, foreignKey, nom de la photo.
- Une table pour le contact.
- A propos.
- info.

*Généralité*
- Effet lors du chargement du site.
- Effet lors des changements de pages.

Note :


filter_var = vérifie si il y a @ et . pour un email

strlen = vérifie longueur d'une string dans un formulaire

trim  = supprime les espaces ien début et fin de chaine de caractère.

capchat dans le formulaire pour vérifier bot.

