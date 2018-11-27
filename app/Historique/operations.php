<?php
	Class Operation{
		private $date, $type, $categorie, $nomCompte, $nom, $montant, $devise, $id;
		public function __construct($date='', $type='', $categorie='', $nomCompte='', $nom='', $montant='', $devise='', $id = ''){
			$this->date = explode('-', $date);
			$this->jour = $this->date[2];
			$this->mois = $this->date[1];
			$this->annee = $this->date[0];

			$this->nom = $nom;
			$this->type = $type;
			$this->categorie = $categorie;
			$this->montant = $montant;

			$this->devise = $devise;
			
			$this->nomCompte = $nomCompte;
			$this->id= $id;

		}

		public function getJour(){
			return $this->jour;
		}

		public function getMois(){
			return $this->mois;
		}

		public function getAnnee(){
			return $this->annee;
		}

		public function getNom(){
			return $this->nom;
		}

		public function getType(){
			return $this->type;
		}

		public function getCategorie(){
			return $this->categorie;
		}

		public function getMontant(){
			return $this->montant;
		}

		public function getDevise(){
		return $this->devise;
		}

		public function getNomCompte(){
		return $this->nomCompte;
		}

		public function getId(){
		return $this->id;
		}
	}
?>