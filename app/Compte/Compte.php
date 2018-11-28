
<?php
	class Compte {
		private $numero, $nom_compte, $solde_initial, $devise, $id;
										/* Constructeurs */

		public function __construct($numero ='', $nom_compte = '',$solde_initial,$solde_actuel ='', $symbole_devise ='', $id = '', $decouvert_max = ''){
			$this->numero = $numero;
			$this->nom_compte = $nom_compte;
			$this->solde_initial = $solde_initial;
			$this->solde_actuel = $solde_actuel;
			$this->symbole_devise = $symbole_devise;
			$this->id = $id;
			$this->decouvert_max = $decouvert_max;
			
		}
										/* Fin constructeurs */ 

										/* Accesseurs */			/* Set : renseigner les données des attributs /* get : lire les données des attributs */
		public function getId(){
			return $this->id;
		}								

		public function getNumero(){
			return $this->numero;
		}
		public function getNom_compte(){
			return $this->nom_compte;
		}
		public function getSolde_initial(){
			return $this->solde_initial;
		}
		public function getSolde_actuel(){
			return $this->solde_actuel;
		}
		public function getSymbole_Devise(){
			return $this->symbole_devise;
		}
		public function getDec_Aut(){
			return $this->dec_aut;
		}
	}
?>