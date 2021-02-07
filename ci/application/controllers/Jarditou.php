<?php
// application/controllers/Produits.php


defined('BASEPATH') OR exit('No direct script access allowed');

class Jarditou extends CI_Controller {


    public function index(){
        
        $aViewHeader = ["title" => "Inscription/connexion"];

        if ($this->input->post()){ // 2ème appel de la page: traitement du formulaire
         
            if (!($this->input->post('submit2'))){ 
    
            $data = $this->input->post();



            // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
            $this->form_validation->set_rules('us_nom', 'Nom', 'required', array("required" => "La %s doit être obligatoire."));
         //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');  
         
            $this->form_validation->set_rules('us_prenom', 'Prenom', 'required', array("required" => "Le %s doit être obligatoire."));
         //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
          
        
            $this->form_validation->set_rules('us_mail', 'Mail', 'required|valid_email', array("required" => "Le %s doit être obligatoire.",   "valid_email"  => "Le format du %s n'est pas valide"));
        //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $this->form_validation->set_rules('us_log', 'Login', 'required|min_length[6]', array("required" => "Le %s doit être obligatoire.",   "min_length"  => "Le %s n'est pas valide, il doit faire 6 caractères au moins"));
            //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $this->form_validation->set_rules('us_mp', 'Mot de passe', 'required|min_length[8]', array("required" => "Le %s doit être obligatoire.",   "min_length"  => "Le %s n'est pas valide, il doit faire 8 caractères au moins"));
            //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            

            //Test existance du mail
            $this->load->model('produitsModel');
            $i = $this->input->post('us_mail');
            $bool = $this->produitsModel->test1($i);
            $this->session->set_flashdata('sUploadError6','Ce mail est pas dans notre base, si celui est non null il sera accepté si sa syntaxe est correct');


            //Test existance du Login
            $this->load->model('produitsModel');
            $i = $this->input->post('us_log');
            $bool1 = $this->produitsModel->test2($i);
            $this->session->set_flashdata('sUploadError7','Ce login est pas dans notre base, si celui est non null il sera accepté si sa syntaxe est correct');
           
            
            
            if ($this->input->post('us_mp') == $this->input->post('us_mp2')){$bool2 = false;}else {$bool2 = true;}
            $this->session->set_flashdata('sUploadError8','Les mots de passes sont bien égaux');

        


            if ($this->form_validation->run() == FALSE || $bool || $bool1 || $bool2){ // Echec de la validation, on réaffiche la vue formulaire 
                
                
                if ($bool){
                    $this->session->set_flashdata('sUploadError6','Ce mail existe déjà');
                    $_SESSION["messMail"]= 'Ce mail existe déjà';
                }
                if ($bool1){
                    $this->session->set_flashdata('sUploadError7','Ce Login existe déjà');
                    $_SESSION["messLogin"]= 'Ce Login existe déjà';
                }
                if($bool2){
                    $this->session->set_flashdata('sUploadError8','Les mots de passes sont différents');
                    $_SESSION["messmdp"]="Les mots de passes sont différents";
                }
                
                
                $this->load->view('jarditou/index',$aViewHeader);
                
            }
            else{ 
             
                $password_hash = password_hash($this->input->post('us_mp'), PASSWORD_DEFAULT);
                $data['us_status'] = 0;
                $data['us_d_ins'] = date("y-m-d");
                $data['us_d_dercon'] = NULL;
                $data['us_mp']=$password_hash;
                
                unset($data["us_mp2"]);
                
                $this->db->insert('users', $data);
                
                $_SESSION["insok"] = ok;
                
                redirect("jarditou");

            }
         
        
        //fin if submit2   
        }
        else{
            // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
            $this->form_validation->set_rules('Log', 'Login', 'required', array("required" => "Veuillez entrer votre login"));
             //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            
            if ($this->form_validation->run() == FALSE){
                $this->load->view('jarditou/index',$aViewHeader);
            }
            else{
            
            $this->load->model('produitsModel');
            $j = $this->input->post('Log');

            $util= $this->produitsModel->connexion($j);
            if (!(empty($util))){
                $mtphash = $util->us_mp;
               if (password_verify( $this->input->post('motdepasse'), $mtphash)){
                     $_SESSION['status'] = $util->us_status;
                     redirect("jarditou/accueil");
                    }
                else{$_SESSION["messlog3"]= "Mot de passe incorrect";
                    $this->load->view('jarditou/index',$aViewHeader);
                }
            }
            else{
                $_SESSION["messlog2"]= "Vous êtes pas connu de jarditou, veuillez vous inscrire";
                $this->load->view('jarditou/index',$aViewHeader);

            }
        }

        }
      
        //fin if imput  
        }
        //formulaire vierge
        else{
           $this->load->view('jarditou/index',$aViewHeader);
        }
      
       
   }

  
  
    public function accueil(){


        $aViewHeader = ["title" => "Accueil"];
        $_SESSION['panier'] = array();
        $this->load->view('jarditou/header/headerIndex',$aViewHeader );
        // Appel de la vue avec transmission du tableau  
       
        $this->load->view('jarditou/accueil');
      
        $this->load->view('jarditou/footer/footer');
   }



    //ne sert plus, la liste est géréé avec pagination via le controlleur pagination
    
    public function liste(){
        // Charge la librairie 'database'
        //$this->load->database();
    
        // Exécute la requête 
        //$results = $this->db->query("SELECT * FROM produits");  
    
        // Récupération des résultats    
        //$aListe = $results->result(); 
        
          // Chargement du modèle 'produitsModel'
        $this->load->model('produitsModel');

        /* On appelle la méthode liste() du modèle,
        * qui retourne le tableau de résultat ici affecté dans la variable $aListe (un tableau) 
        * remarque la syntaxe $this->nomModele->methode()       
        */
        $aListe = $this->produitsModel->liste();
    
        // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue   
        $aView["liste_produits"] = $aListe;
        $aViewHeader = ["title" => "Tableau"];
        
        $this->load->view('jarditou/header/headerTableau',$aViewHeader );
         // Appel de la vue avec transmission du tableau  
        if (isset($_SESSION['status']) and $_SESSION['status'] == 1){
            $this->load->view('jarditou/tableauadmin', $aView);
        }
        else{
            $this->load->view('jarditou/tableau', $aView);
        }
       
        $this->load->view('jarditou/footer/footer');
    }

    public function contact(){


    $aViewHeader = ["title" => "Contact"];


     if ($this->input->post()){ // 2ème appel de la page: traitement du formulaire
         
             
        $data = $this->input->post();

        $Nomok = $Prenomok = $Sexeok = $Dateok = $Cpok = $adrok = $Villeok = $courrielok = $Sujetok = $questionok =  false;

        if (preg_match('#[a-zA-Z]+#',  $this->input->post('Nom')))
            {$_SESSION["messNom"] = "";
            $Nomok = true;
            }
else  $_SESSION["messNom"] = "Veuillez entrer un nom valide";


if (preg_match('#[a-zA-Z]+#',$this->input->post('Prenom')))
    {$_SESSION["messPrenom"] = "";
     $Prenomok = true;
    }
else  $_SESSION["messPrenom"] = "Veuillez entrer un prénom valide";

if (($this->input->post('sexe') == 'M')){
    $_SESSION["messSexe"] = "";
    $_SESSION["Sexe"] = 'M';
    $Sexeok = true;
}
else { 
    if (($this->input->post('sexe') == 'F')){
        $_SESSION["messSexe"] = "";
        $_SESSION["Sexe"] = 'F';
        $Sexeok = true;
    }
    else {
        $_SESSION["messSexe"] = "Veuillez renseigner votre sexe";
    }
}


if (preg_match('#[0-9]{2}\/[0-9]{2}\/[0-9]{4}#', $this->input->post('date')))
    {$_SESSION["messDate"] = "";
    $Dateok = true;
    }
else  $_SESSION["messDate"] = "Veuillez entrer une date de naissance valide";


if (preg_match('#[0-9]{5}#', $this->input->post('CodePostal')))
    {$_SESSION["messCp"] = "";
     $Cpok = true;
    }
else  $_SESSION["messCp"] = "Veuillez entrer un code postal valide";


if (preg_match('#[1-9]+ .+#', $this->input->post('Adresse')))
    {$_SESSION["messAdr"] = "";
    $adrok = true;
    }
else  $_SESSION["messAdr"] = "Veuillez entrer une adresse valide";


if (preg_match('#[a-zA-Z]{1}[a-z]*#', $this->input->post('Ville')))
    {$_SESSION["messVille"] = "";
    $Villeok = true;
    }
else  $_SESSION["messVille"] = "Veuillez entrer une ville valide";


if (preg_match('#[_a-z0-9-]+(.\[_a-z0-9-]+)*@[a-z]+\.[a-z]{2,3}#', $this->input->post('courriel')))
    {$_SESSION["messMail"] = "";
    $courrielok = true;
    }
else  $_SESSION["messMail"] = "Veuillez entrer un email valide";



if ($this->input->post('Sujet') == 0){
    $_SESSION["messSujet"] = "Veuiller sélectionner un sujet";
}
if ($this->input->post('Sujet')  == 1){
    $_SESSION["messSujet"] = "";
    $_SESSION["Sujet"]=1;
    $Sujetok = true;
}
if ($this->input->post('Sujet') == 2){
    $_SESSION["messSujet"] = "";
    $_SESSION["Sujet"]=2;
    $Sujetok = true;
}
if ($this->input->post('Sujet') == 3){
    $_SESSION["messSujet"] = "";
    $_SESSION["Sujet"]=3;
    $Sujetok = true;
}
if ($this->input->post('Sujet') == 4){
    $_SESSION["messSujet"] = "";
    $_SESSION["Sujet"]=4;
    $Sujetok = true;
}



if (preg_match('#.+#', $this->input->post('question')))
    {$_SESSION["messQuest"] = "";
    $questionok  = true;
    }
else  $_SESSION["messQuest"] = "Veuillez saisir une question";




if (!($Nomok and $Prenomok and $Sexeok and $Dateok and $Cpok and $adrok and $Villeok and $courrielok and $Sujetok and $questionok )){
    $this->load->view('jarditou/header/headerContact',$aViewHeader);
       
       
    $this->load->view('jarditou/contact');
      
    $this->load->view('jarditou/footer/footer');
}
else {
    $_SESSION["enrcontactok"]= "ok";
    $_SESSION["Sujet"]="";
    $_SESSION['Sexe']="";
    $_SESSION["messNom"]="";
    $_SESSION["messPrenom"]="";
    $_SESSION["messSexe"]="";
    $_SESSION["messDate"]="";
    $_SESSION["messCp"]="";
    $_SESSION["messAdr"]="";
    $_SESSION["messVille"]="";
    $_SESSION["messMail"]="";
    $_SESSION["messSujet"]="";
    $_SESSION["messQuest"]="";
   

   
    unset($_SESSION["Sexe"]);
    unset($_SESSION["Sujet"]);
    unset($_SESSION["messNom"]);
    unset($_SESSION["messPrenom"]);
    unset($_SESSION["messSexe"]);
    unset($_SESSION["messDate"]);
    unset($_SESSION["messCp"]);
    unset($_SESSION["messAdr"]);
    unset($_SESSION["messVille"]);
    unset($_SESSION["messMail"]);
    unset($_SESSION["messSujet"]);
    unset($_SESSION["messQuest"]);
   
    
    redirect("jarditou/contact");
    }


    }
        
    else{

    $this->load->view('jarditou/header/headerContact',$aViewHeader );
       
       
    $this->load->view('jarditou/contact');
      
    $this->load->view('jarditou/footer/footer');
        }
}

    public function detail($id){
        // Charge la librairie 'database'
        //$this->load->database();
    
        // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
        //$produit = $this->db->query("SELECT * FROM produits join categories on cat_id = pro_cat_id  WHERE pro_id= ?", $id);
        //$aView["produit"] = $produit->row(); // première ligne du résultat  
        $this->load->model('produitsModel');
        $aListe = $this->produitsModel->prod($id);
        $aView["produit"] = $aListe;
        $aViewHeader = ["title" => "Détails produit administrateur"];
        
        $this->load->view('jarditou/header/headerDetail',$aViewHeader );
         // Appel de la vue avec transmission du tableau  
        
         if (isset($_SESSION['status']) and $_SESSION['status'] == 1){
            $this->load->view('jarditou/detailadmin', $aView);
        }
        else{
            $this->load->view('jarditou/detail', $aView);
        }
       
        $this->load->view('jarditou/footer/footer');
    }


    public function ajouter()
    {
        
        // Chargement des assistants 'form' et 'url'
        //$this->load->helper('form', 'url'); 
    
        // Chargement de la librairie 'database'
        //$this->load->database();  
    
        // Chargement de la librairie form_validation
        //$this->load->library('form_validation'); 
        $aViewHeader = ["title" => "Ajout d'un produit"];
    
        // Requête de sélection de l'enregistrement 
      
        $this->load->model('ProduitsModel');
        
        /*$aListe = $this->produitsModel->Cat();  
        $aView["liste_categorie"] = $aListe; */

 
        //Existance Référence
        $aListe = $this->ProduitsModel->liste();
        $ref["ref"] = $aListe; 
        $bool=false; 

        

        
    
        if ($this->input->post()) 
        { // 2ème appel de la page: traitement du formulaire
    
            $data = $this->input->post();

            foreach ($ref["ref"] as $row){
                if(($row->pro_ref == $this->input->post('pro_ref')) ){
                   $bool=true;
                   }
            }
    
            

           
           
    
        // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
            $this->form_validation->set_rules('pro_ref', 'Référence', 'required|max_length[10]', array("required" => "La %s doit être obligatoire.", "max_length" => "10 caractères maximum"));
         //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');  

            $this->form_validation->set_rules('pro_cat_id', 'Catégorie', 'required', array("required" => "La %s doit être obligatoire."));
            //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
         
            $this->form_validation->set_rules('pro_prix', 'Prix', 'required|greater_than[0]', array("required" => "Le %s doit être obligatoire.", "greater_than" => "Le %s doit être un nombre positif."));
         //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
          
        
            $this->form_validation->set_rules('pro_stock', 'Stock', 'required|is_natural', array("required" => "Le %s doit être obligatoire.","is_natural" => "Le %s doit être un entier positif ou nul."));
        //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
            
           
            if ($_FILES){
            // On extrait l'extension du nom du fichier 
            // Dans $_FILES["pro_photo"], pro_photo est la valeur donnée à l'attribut name du champ de type 'file'  
                $extension = substr(strrchr($_FILES["fichier"]["name"], "."), 1);
            
            }
        
  
           
            
            if ($this->form_validation->run() == FALSE || $bool){ // Echec de la validation, on réaffiche la vue formulaire 
                $this->session->set_flashdata('sUploadError3','Cette référence est pas connu de la base, elle est acceptable si non null');
                if ($bool){$_SESSION['ref']="La référence existe déjà";}
                
                $this->load->view('jarditou/header/headerDetail',$aViewHeader);            
                $this->load->view('jarditou/ajout');
                $this->load->view('jarditou/footer/footer2');
                }
           
            else{ // La validation a réussi, nos valeurs sont bonnes, on peut insérer en base
            $data['pro_photo'] = $extension;
            
            //Ajax (les 2 select)
            if (! ($this->input->post('pro_cat_id2') == "")){
                $data['pro_cat_id']=$this->input->post('pro_cat_id2');
                unset($data['pro_cat_id2']);
            }
            else {unset($data['pro_cat_id2']);}


        
            
            $this->db->insert('produits', $data);

            $id = $this->ProduitsModel->maxid();
            $id=$id->valeur;

                /*$req= "SELECT MAX(pro_id) as value from Produits";
                $row = $this->db->query($req);
                $id= $row->first_row();
                $id=$id->value;*/
          
          

            // On créé un tableau de configuration pour l'upload
                $config['upload_path'] = './assets/images/'; // chemin où sera stocké le fichier
         
         // nom du fichier final
                $config['file_name'] = $id.'.'.$extension; 
        

         // On indique les types autorisés (ici pour des images)
                $config['allowed_types'] = 'gif|jpg|jpeg|png'; 

                $config['max_size'] = 2500;
                $config['max_width'] = 2500;
                $config['max_height'] = 2500;

         // On charge la librairie 'upload'
                $this->load->library('upload');

         // On initialise la config 
                $this->upload->initialize($config);
            
        //Pourrécupérer (dans un tableau PHP) les informations d'origine sur le fichier téléchargé.
                $aUploadDatas = $this->upload->data(); 
          
        // La méthode do_upload() effectue les validations sur l'attribut HTML 'name' ('fichier' dans notre formulaire) et si OK renomme et déplace le fichier tel que configuré
                if ( ! $this->upload->do_upload('fichier')){
            
            // Echec : on récupère les erreurs dans une variable (une chaîne)
                    $sUploadErrors = $this->upload->display_errors();    

            // on réaffiche la vue du formulaire en passant les erreurs 
                    $aView["sUploadErrors"] = $sUploadErrors;

            /* On envoie le message d'erreur dans le fichier php_error.log,
                                                      */
                    error_log($sUploadErrors, 0);

            /* Pour l'utilisateur, on envoie un message flash
            * n'oubliez pas, cela nécessite la librairie 'session'*/ 
                    //$this->load->library('session'); 
                   $this->session->set_flashdata('sUploadError2','Aucun fichier joint ou le téléchargement du fichier à échoué, les formats acceptés gif|jpg|jpeg|png');
                   $_SESSION['fich']='Aucun fichier joint ou le téléchargement du fichier à échoué, les formats acceptés gif|jpg|jpeg|png' ;

            // Réaffichage du formulaire

                    $this->db->where('pro_id',$id);
                    $this->db->delete('produits'); 
                    $this->load->view('jarditou/header/headerDetail',$aViewHeader);
                    $this->load->view('jarditou/ajout');
                    $this->load->view('jarditou/footer/footer2');
                }
                 else{ // Succès, on redirige sur la liste 
                     redirect("Pagination");
                    }
                }       
            }  
    else 
        { // 1er appel de la page: affichage du formulaire 
           $this->load->view('jarditou/header/headerDetail',$aViewHeader);
           $this->load->view('jarditou/ajout');
           $this->load->view('jarditou/footer/footer2');
        }
    } // --ajout()




    public function modifier($id)
    {
        // Chargement des assistants 'form' et 'url'
        //$this->load->helper('form', 'url'); 
    
        // Chargement de la librairie 'database'
        //$this->load->database();  
    
        // Chargement de la librairie form_validation
        //$this->load->library('form_validation'); 
        $aViewHeader = ["title" => "Mofification d'un produit"];
    
        // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
        $this->load->model('ProduitsModel');
        $aListe = $this->ProduitsModel->prod($id);
        $aView["produit"] = $aListe;
        $_SESSION['id_cat']=$aListe->pro_cat_id;
        
        /*$aListe = $this->produitsModel->Cat();  
        $aView["liste_categorie"] = $aListe;*/ 

        //Existance Référence
        $aListe = $this->ProduitsModel->liste();
        $ref["ref"] = $aListe; 

        //pour le bon selected
      
        
        $bool=false; 
    
        if ($this->input->post()) 
        { // 2ème appel de la page: traitement du formulaire
    
            $data = $this->input->post();

            foreach ($ref["ref"] as $row){
                if(($row->pro_ref == $this->input->post('pro_ref')) and ($this->input->post('pro_ref') != $aView["produit"]->pro_ref) ){
                    $bool=true;
                   

                }
            }
           
    
        // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
         $this->form_validation->set_rules('pro_ref', 'Référence', 'required|max_length[10]', array("required" => "La %s doit être obligatoire.", "max_length" => "10 caractères maximum"));
         //Mise en page personaliser du message d'erreur
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');  

         $this->form_validation->set_rules('pro_cat_id', 'Catégorie', 'required', array("required" => "La %s doit être obligatoire."));
         //Mise en page personaliser du message d'erreur
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 
         
         $this->form_validation->set_rules('pro_prix', 'Prix', 'required|greater_than[0]', array("required" => "Le %s doit être obligatoire.", "greater_than" => "Le %s doit être un nombre positif."));
         //Mise en page personaliser du message d'erreur
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
          
        
         $this->form_validation->set_rules('pro_stock', 'Stock', 'required|is_natural', array("required" => "Le %s doit être obligatoire.","is_natural" => "Le %s doit être un entier positif ou nul."));
        //Mise en page personaliser du message d'erreur
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 

         
        
         
    
           if ($this->form_validation->run() == FALSE || $bool)
           { // Echec de la validation, on réaffiche la vue formulaire
            $this->session->set_flashdata('sUploadError3','Cette référence est pas connu de la base, elle est acceptable si non null');
            if ($bool){$_SESSION['ref']="La référence existe déjà";}
            
            $this->load->view('jarditou/header/headerDetail',$aViewHeader);            
            $this->load->view('jarditou/modification', $aView);
            $this->load->view('jarditou/footer/footer1');
           }
           else
           { // La validation a réussi, nos valeurs sont bonnes, on peut modifier en base  
    
              /* Utilisation de la méthode where() toujours 
              * avant select(), insert() ou update()
              * dans cette configuration sur plusieurs lignes 
              */
               
              //Ajax (les 2 select)
            if (! ($this->input->post('pro_cat_id2') == "")){
                $data['pro_cat_id']=$this->input->post('pro_cat_id2');
                unset($data['pro_cat_id2']);
            }
            else {unset($data['pro_cat_id2']);}


            $this->db->where('pro_id', $id);
            $this->db->update('produits', $data);
    
              redirect("Pagination");
          }
        } 
        else 
        { // 1er appel de la page: affichage du formulaire 
            
           $this->load->view('jarditou/header/headerDetail',$aViewHeader);
           $this->load->view('jarditou/modification',$aView);
           $this->load->view('jarditou/footer/footer1');
        }
    } // -- modifier()


    public function supprimer($id)
    {
        // Chargement des assistants 'form' et 'url'
        //$this->load->helper('form', 'url'); 
    
        // Chargement de la librairie 'database'
        //$this->load->database();  
    
        
    
        // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
        $this->load->model('ProduitsModel');
        $aListe = $this->ProduitsModel->prod($id);
        $aView["produit"] = $aListe;
        $aViewHeader = ["title" => "Supression d'un produit"];
    
        if ($this->input->post()) 
        { // 2ème appel de la page: traitement du formulaire
              //$data = $this->input->post();
              $this->db->where('pro_id',$id);
              $this->db->delete('produits');
    
              redirect("Pagination");
        } 
        else 
        { // 1er appel de la page: affichage du formulaire 
            $this->load->view('jarditou/header/headerDetail',$aViewHeader );
        // Appel de la vue avec transmission du tableau          
           $this->load->view('jarditou/supprime', $aView);
           $this->load->view('jarditou/footer/footer');
        }
    } // -- supprimer()


    public function admin(){

       if ($this->input->post()){ // 2ème appel de la page: traitement du formulaire
         
           
            $data = $this->input->post();



            // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
            $this->form_validation->set_rules('us_nom', 'Nom', 'required', array("required" => "La %s doit être obligatoire."));
         //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');  
         
            $this->form_validation->set_rules('us_prenom', 'Prenom', 'required', array("required" => "Le %s doit être obligatoire."));
         //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
          
        
            $this->form_validation->set_rules('us_mail', 'Mail', 'required|valid_email', array("required" => "Le %s doit être obligatoire.",   "valid_email"  => "Le format du %s n'est pas valide"));
        //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $this->form_validation->set_rules('us_log', 'Login', 'required|min_length[6]', array("required" => "Le %s doit être obligatoire.",   "min_length"  => "Le %s n'est pas valide, il doit faire 6 caractères au moins"));
            //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            $this->form_validation->set_rules('us_mp', 'Mot de passe', 'required|min_length[8]', array("required" => "Le %s doit être obligatoire.",   "min_length"  => "Le %s n'est pas valide, il doit faire 8 caractères au moins"));
            //Mise en page personaliser du message d'erreur
            $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');

            

            //Test existance du mail
            $this->load->model('produitsModel');
            $i = $this->input->post('us_mail');
            $bool = $this->produitsModel->test1($i);
            $this->session->set_flashdata('sUploadError6','Ce mail est pas dans notre base, si celui est non null il sera accepté si sa syntaxe est correct');


            //Test existance du Login
            $this->load->model('produitsModel');
            $i = $this->input->post('us_log');
            $bool1 = $this->produitsModel->test2($i);
            $this->session->set_flashdata('sUploadError7','Ce login est pas dans notre base, si celui est non null il sera accepté si sa syntaxe est correct');
           
            
            
            if ($this->input->post('us_mp') == $this->input->post('us_mp2')){$bool2 = false;}else {$bool2 = true;}
            $this->session->set_flashdata('sUploadError8','Les mots de passes sont bien égaux');

        


            if ($this->form_validation->run() == FALSE || $bool || $bool1 || $bool2){ // Echec de la validation, on réaffiche la vue formulaire 
                
                
                if ($bool){
                    $this->session->set_flashdata('sUploadError6','Ce mail existe déjà');
                    $_SESSION["messMail"]= 'Ce mail existe déjà';
                }
                if ($bool1){
                    $this->session->set_flashdata('sUploadError7','Ce Login existe déjà');
                    $_SESSION["messLogin"]= 'Ce Login existe déjà';
                }
                if($bool2){
                    $this->session->set_flashdata('sUploadError8','Les mots de passes sont différents');
                    $_SESSION["messmdp"]="Les mots de passes sont différents";
                }
                
                
                $this->load->view('jarditou/admin');
                
            }
            else{ 
             
                $password_hash = password_hash($this->input->post('us_mp'), PASSWORD_DEFAULT);
                $data['us_status'] = 1;
                $data['us_d_ins'] = date("y-m-d");
                $data['us_d_dercon'] = NULL;
                $data['us_mp']=$password_hash;
                
                unset($data["us_mp2"]);
                
                $this->db->insert('users', $data);
                
                $_SESSION["insok"] = ok;
                
                redirect("jarditou/admin");

        
      
      
        }
    //fin if imput  
    }
    else{
        $this->load->view('jarditou/admin');
    }
      
}


public function afficherPanier()
{
    $aViewHeader = ["title" => "Panier"];
    $this->load->view('jarditou/header/headerDetail',$aViewHeader );
    $this->load->view('jarditou/panier');
    $this->load->view('jarditou/footer/footer');
}

//Panier
public function ajouterPanier() 
{
    // On récupère les données du formulaire 
    $aData = $this->input->post(); 
    
    // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
    $this->form_validation->set_rules('pro_qte', 'Quantité', 'required|is_natural_no_zero', array("required" => "La %s doit être obligatoire.", "is_natural_no_zero" => "La %s doit être positif"));
    //Mise en page personaliser du message d'erreur
    $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>'); 

    if ($this->form_validation->run() == FALSE){
        $_SESSION['errqte'] = "La quantité doit être positif";
        // On redirige sur la liste
        redirect("Pagination/index");
    }
    else{
    


    // Au 1er article ajouté, création du panier car il n'existe pas
    if (count($_SESSION['panier']) == 0) 
    {
        // On créé un tableau pour stocker les informations du produit  
        $aPanier = array();

        // On ajoute les infos du produit ($aData) au tableau du panier ($aPanier) 
        array_push($aPanier, $aData);  

        // On stocke le panier dans une variable de session nommée 'panier'            
        $_SESSION['panier'] = $aPanier;
        // On redirige sur la liste
        redirect("Pagination/index");


        // 
     }
     else
     { // le panier existe (on a déjà mis au moins un article) 

         // On récupère le contenu du panier en session           
         $aPanier = $_SESSION['panier'];

         $pro_id = $this->input->post('pro_id');

         $bSortie = FALSE;

         // on cherche si le produit existe déjà dans le panier
         foreach ($aPanier as $produit) 
         {
             if ($produit['pro_id'] == $pro_id)
             {
                  $bSortie = TRUE;
             }
         }

         if ($bSortie) 
         { // si le produit est déjà dans le panier, l'utilisateur est averti
             
            $_SESSION['existeproduit'] = "Produit déjà selectionné";
             // On redirige sur la liste
             redirect("Pagination/index");
         }
         else 
         { // sinon, le produit est ajouté dans le panier
            array_push($aPanier, $aData);

            // On remet le tableau des produitss que  
            $_SESSION['panier'] = $aPanier;
            redirect("Pagination/index");
         }
     }
    }
}

//panier
public function supprimerProduit($pro_id)
{
    $aPanier = $_SESSION['panier'];

    $aTemp = array(); //création d'un tableau temporaire vide

    for ($i=0; $i<count($aPanier); $i++) //on cherche dans le panier les produits à ne pas supprimer
    {
        if ($aPanier[$i]['pro_id'] != $pro_id)
        {
             array_push($aTemp, $aPanier[$i]); // ces produits sont ajoutés dans le tableau temporaire
        }
    }

   $aPanier = $aTemp;
   unset($aTemp);
   $_SESSION['panier'] = $aPanier; // le panier prend la valeur du tableau temporaire et ne contient donc plus le produit à supprimer

   // On réaffiche le panier 
   redirect("jarditou/afficherPanier");
}


//Panier
public function supprimepanier(){
    $_SESSION['panier'] = array();
     // On réaffiche le panier 
    redirect("jarditou/afficherPanier");

}

public function ajoutQuantite($pro_id)
{
    $aPanier = $_SESSION['panier'];

    $aTemp = array(); //création d'un tableau temporaire vide

    // On parcourt le tableau produit après produit
    for ($i = 0; $i < count($aPanier); $i++) 
    {
        if ($aPanier[$i]['pro_id'] != $pro_id)
        {
            array_push($aTemp, $aPanier[$i]);
        }
        else
        {
            $aPanier[$i]['pro_qte']++;
            array_push($aTemp, $aPanier[$i]);
        }
    }

    $aPanier = $aTemp;
    unset($aTemp);
    $_SESSION['panier'] = $aPanier;

    // On réaffiche le panier 
    redirect("jarditou/afficherPanier");
}

public function diminueQuantite($pro_id){
    $aPanier = $_SESSION['panier'];

    $aTemp = array(); //création d'un tableau temporaire vide

    // On parcourt le tableau produit après produit
    for ($i = 0; $i < count($aPanier); $i++) 
    {
        if ($aPanier[$i]['pro_id'] != $pro_id)
        {
            array_push($aTemp, $aPanier[$i]);
        }
        else{
            if ($aPanier[$i]['pro_qte'] == 1){
                redirect("jarditou/supprimerProduit/".$pro_id);
            }
            else {
                $aPanier[$i]['pro_qte']--;
                array_push($aTemp, $aPanier[$i]);
            }
        }
    }

    $aPanier = $aTemp;
    unset($aTemp);
    $_SESSION['panier'] = $aPanier;

    // On réaffiche le panier 
    redirect("jarditou/afficherPanier");
}


public function option1(){
    
    $this->load->model('ProduitsModel');
    $data['option1']= $this->ProduitsModel->cat();

    //Pour non json
   // $this->load->view('jarditou/option1v',$data);
    
    //Pour json
    echo json_encode($data['option1']);
  }

public function option2($v){
 
    $this->load->model('ProduitsModel');
    $data['option2']= $this->ProduitsModel->cat2($v);

    //Pour non json
    //$this->load->view('jarditou/option2v',$data);

    //Pour json
    echo json_encode($data['option2']);


  }


}

?>