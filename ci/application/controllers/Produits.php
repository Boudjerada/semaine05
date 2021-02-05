<?php
// application/controllers/Produits.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produits extends CI_Controller 
{

    public function liste()
    {
        // Déclaration du tableau associatif à tranmettre à la vue
        $aView = array();
        $aViewHeader = array();

        
        
        
        // Dans le tableau, on créé une donnée 'prénom' et 'nom" qui a pour valeur 'Dave' et 'Loper'    
        $aView["prenom"] = "Dave";
        $aView["nom"] = "Loper"; 
       
        // Appel des différents morceaux de vues
       
        // On passe le tableau en second argument de la méthode 
        $this->load->view('liste', $aView);
      
    }

    public function prod()
    {
        // Déclaration du tableau associatif à tranmettre à la vue
        $aProduits= array();
        // Dans le tableau, on créé une donnée 'prénom' qui a pour valeur 'Dave'   
        $aProduits = ["Aramis", "Athos", "Clatronic", "Camping", "Green"]; 
        //Taille tableau
        $aProduits["taille"]= count($aProduits);
        $i=1;
        foreach($aProduits as $produit){
            $aProduits["produit".$i]=$produit;
        $i++;
        }

        $this->load->view('prod',$aProduits);
    }

    public function jarditou()
    {
        // Charge la librairie 'database'
        $this->load->database();
    
        // Exécute la requête 
        $results = $this->db->query("SELECT * FROM produits");  
    
        // Récupération des résultats    
        $aListe = $results->result();   
    
        // Ajoute des résultats de la requête au tableau des variables à transmettre à la vue   
        $aView["liste_produits"] = $aListe;
    
        // Appel de la vue avec transmission du tableau  
        $this->load->view('jarditou', $aView);
    }

    public function home_view(){
        
        /* Un premier tableau à passer au morceau de vue 'header', celui-ci contient une valeur pour la balise <title> de la page */ 
        $aViewHeader = ["title" => "Liste des produits"];
        
        $this->load->view('header',$aViewHeader );
        $this->liste();
        $this->prod();
        $this->jarditou();
        $this->load->view('footer');

        $this->load->view('home_view');
       
    }

    public function ajouter(){
    // Chargement des assistants 'form' et 'url'
    //$this->load->helper('form', 'url'); 

    // Chargement de la librairie 'database' pour connexion a jarditou
    //$this->load->database(); 

    // Chargement de la librairie form_validation pour vérifification des champs du formulaire
    //$this->load->library('form_validation'); 

    if ($this->input->post()) 
    { // 2ème appel de la page: traitement du formulaire
 
         $data = $this->input->post();
 
         // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
         $this->form_validation->set_rules('pro_ref', 'Référence', 'required|min_length[6]', array("required" => "Le %s doit être obligatoire.", "min_length" => "Le %s doit avoir longueur minimum de 6 caractères."));
         //Mise en page personaliser du message d'erreur
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');  
         if ($this->form_validation->run() == FALSE)
         { // Echec de la validation, on réaffiche la vue formulaire 
 
               $this->load->view('ajouter');
         }
         else
         { // La validation a réussi, nos valeurs sont bonnes, on peut insérer en base
 
             $this->db->insert('produits', $data);
 
             redirect("produits/home_view");
         }       
     } 
     else 
     { // 1er appel de la page: affichage du formulaire
            $this->load->view('ajouter');
     }
    } 


    public function modifier($id)
    {
        // Chargement des assistants 'form' et 'url'
        //$this->load->helper('form', 'url'); 
    
        // Chargement de la librairie 'database'
        //$this->load->database();  
    
        // Chargement de la librairie form_validation
        //$this->load->library('form_validation'); 
    
        // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
        $produit = $this->db->query("SELECT * FROM produits WHERE pro_id= ?", $id);
        $aView["produit"] = $produit->row(); // première ligne du résultat
    
        if ($this->input->post()) 
        { // 2ème appel de la page: traitement du formulaire
    
           $data = $this->input->post();
           
    
           // Définition des filtres, ici une valeur doit avoir été saisie pour le champ 'pro_ref'
         $this->form_validation->set_rules('pro_ref', 'Référence', 'required|min_length[6]', array("required" => "Le %s doit être obligatoire.", "min_length" => "Le %s doit avoir longueur minimum de 6 caractères."));
        //Mise en page personaliser du message d'erreur
         $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');  
    
           if ($this->form_validation->run() == FALSE)
           { // Echec de la validation, on réaffiche la vue formulaire 
               $this->load->view('modifier', $aView);
           }
           else
           { // La validation a réussi, nos valeurs sont bonnes, on peut modifier en base  
    
              /* Utilisation de la méthode where() toujours 
              * avant select(), insert() ou update()
              * dans cette configuration sur plusieurs lignes 
              */
              // Ajout d'une date d'ajout que le formulaire ne contient pas
               
              $this->db->where('pro_id', $id);
              $this->db->update('produits', $data);
    
              redirect("produits/home_view");
          }
        } 
        else 
        { // 1er appel de la page: affichage du formulaire             
           $this->load->view('modifier', $aView);
        }
    } // -- modifier()



    public function supprimer($id)
    {
        // Chargement des assistants 'form' et 'url'
        //$this->load->helper('form', 'url'); 
    
        // Chargement de la librairie 'database'
        //$this->load->database();  
    
        
    
        // Requête de sélection de l'enregistrement souhaité, ici le produit 7 
        $produit = $this->db->query("SELECT * FROM produits WHERE pro_id= ?", $id);
        $aView["produit"] = $produit->row(); // première ligne du résultat
    
        if ($this->input->post()) 
        { // 2ème appel de la page: traitement du formulaire
              //$data = $this->input->post();
              $this->db->where('pro_id',$id);
              $this->db->delete('produits');
    
              redirect("produits/home_view");
        } 
        else 
        { // 1er appel de la page: affichage du formulaire             
           $this->load->view('supprimer', $aView);
        }
    } // -- supprimer()

}

?>