
<?php 
if (!defined('BASEPATH')) exit('No direct script access allowed');
header('Access-Control-Allow-Origin: http://localhost/ajax_demo');  
class ProduitsModel extends CI_Model
{
    
    //Pagination

        protected $table = 'produits';
    
        public function __construct() {
            parent::__construct();
        }
    
        public function get_counter() {
            return $this->db->count_all($this->table);
        }
    
        public function get_prod($limit, $start) {
            $this->db->select('*');
            $this->db->from($this->table);
            $this->db->join('categories', 'pro_cat_id = cat_id');
            $this->db->limit($limit, $start);
            $query = $this->db->get();
            return $query->result();
        }
    

     public function liste() 
     {
         $this->load->database();
         $requete = $this->db->query("SELECT * FROM produits");
         $aProduits = $requete->result();  

         return $aProduits;            
     } // -- liste() 
     
     
     public function prod($id)
     {
         $this->load->database();
         $requete = $this->db->query("SELECT * FROM produits join categories on cat_id = pro_cat_id  WHERE pro_id= ?", $id);
         $Produit = $requete->row();

         return $Produit;            
     } // -- prod() 

     public function cat()
     {
         $this->load->database();
         $requete = $this->db->query("SELECT * FROM categories");
         $aCat = $requete->result(); 
        
        return $aCat;            
     } // -- prod() 



     //Pour ajax requete de sous catégorie
     public function cat2($id_cat)
     {
         $this->load->database();
         $requete = $this->db->query("SELECT * FROM categories where cat_parent= ?", $id_cat);
         $aCat = $requete->result(); 

         return $aCat;            
     } // -- prod() 



     //Pour test mail inscription
    public function test1($mail)
    {
        $this->load->database();
        $requete = $this->db->query("SELECT * FROM users  WHERE us_mail= ?", $mail);
        $nbemail = $requete->row();

        return (!empty($nbemail)); 

    }

     //Pour test login inscriptin
     public function test2($log)
     {
         $this->load->database();
         $requete = $this->db->query("SELECT * FROM users  WHERE us_log= ?", $log);
         $nblog = $requete->row();
 
         return (!empty($nblog)); 
 
     }

     //Connexion
     public function connexion($log)
     {
         $this->load->database();
         $requete = $this->db->query("SELECT * FROM users  WHERE us_log= ?", $log);
         $us = $requete->row();

         return $us;            
     } // -- user() 


     public function maxid(){
        $this->load->database();
        $requete = $this->db->query("SELECT MAX(pro_id) as 'valeur' from Produits");
        $id= $requete->first_row();
        return($id);

     }







} // -- ProduitsModel

?>