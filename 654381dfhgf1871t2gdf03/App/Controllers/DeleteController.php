<?php

namespace App\Controllers;

use Library\LayoutController;
use App\Models\AboutModel;
use App\Models\ActualitiesModel;
use App\Models\ContactModel;
use App\Models\AlbumsModel;
use App\Models\CategoriesModel;
use App\Models\PhotosModel;

class DeleteController extends LayoutController
{
    public function deleteOneMail():void
    {
        $id = $_GET["id"];
        $model = new ContactModel;
        $model->deleteOneMail($id);
        header("location: index.php?route=mails");
    }

    public function deleteOnePhoto():void
    {
        
        $phtName = $_GET["pht_name"];
        $albmId = $_GET["albm_id"];
        $model = new PhotosModel;
        $model->deleteOnePhoto($phtName);

        unlink("../assets/img/photos/$albmId/$phtName");
        
        header("location: index.php?route=gallery&id=".$albmId);
    }

    public function deleteOneAlbum():void
    {
        $albmId = $_GET["albm_id"];
        $albmPthName = $_GET["albm_photo"];
        $albmDir = "../assets/img/photos/".$albmId;
        $model = new AlbumsModel;

        $this->delTree($albmDir);
        $model->deleteOneAlbum($albmId);

        unlink("../assets/img/albm_photos/$albmPthName");
        header("location: index.php?route=albums");
    }

    public function deleteOneCategorie():void
    {
        $catId = $_GET["cat_id"];
        $albmModel = new AlbumsModel;
        $catModel = new CategoriesModel;
        $albumsList = $albmModel->getAlbumsbyId($catId);

        foreach($albumsList as $album)
        {
            $albmId = $album["albm_id"];
            $albmPthName = $album["albm_photo"];
            $albmDir = "../assets/img/photos/".$albmId;

            $this->delTree($albmDir);
            $albmModel->deleteOneAlbum($album["albm_id"]);
            unlink("../assets/img/albm_photos/".$albmPthName);
        }

        $catModel->deleteOneCategorie($catId);
        header("location: index.php?route=albums");
    }

    public function deleteOneActualitie():void
    {
        $act_id = $_GET["act_id"];
        $model = new ActualitiesModel;
        $phtName = $model->getPhtName($act_id);
        unlink("../assets/img/actu_img/$phtName");
        $model->deleteActualitieById($act_id);
        header("location: index.php?route=actualities");
    }

    public function deleteAboutContent():void
    {
        //Un case capable de filtrer l'information reçu.
        //Et d'envoyer vers la bonne data au model.
        //Qui supprime le contenu en fonction des infos donnés.
        $model = new AboutModel;
        if(isset($_GET) && !empty($_GET))
        {
            switch($_GET)
                {
                    case(isset($_GET["abt_photo"]) && !empty($_GET["abt_photo"])):
                        $phtName = $_GET["abt_photo"];
                        $column = "abt_photo";
                        $model->deleteAboutContent($column);
                        unlink("../assets/img/about_img/$phtName");
                        break;
                    case(isset($_GET["abt_content"]) && !empty($_GET["abt_content"])):
                        $column = "abt_content";
                        $model->deleteAboutContent($column);
                        break;
                    case(isset($_GET["abt_facebook"]) && !empty($_GET["abt_facebook"])):
                        $column = "abt_facebook";
                        $model->deleteAboutContent($column);
                        break;
                    case(isset($_GET["abt_instagram"]) && !empty($_GET["abt_instagram"])):
                        $column = "abt_instagram";
                        $model->deleteAboutContent($column);
                        break;
                    case(isset($_GET["abt_twitter"]) && !empty($_GET["abt_twitter"])):
                        $column = "abt_twitter";
                        $model->deleteAboutContent($column);
                        break;
                }
            header("location: index.php?route=about");
        }
    }
    
    public function delTree($dir)
        {
            $files = array_diff(scandir($dir), array('.','..'));
            foreach ($files as $file) {
              (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
            }
            return rmdir($dir);
        }
}



