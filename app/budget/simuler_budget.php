<!DOCTYPE html>
<html>
<head>
	<TITLE>Simuler budget</TITLE>
	<meta charset="utf-8">
	<link href="style.css" rel="stylesheet">
</head>
<body>
	
	<h1>Simuler mon budget</h1>

	<div class="blocRevenusFixes">
		<div class="titreBloc">
			<h2>Revenus fixes</h2>
		</div>
		<form name="revenusFixes">
			<div id="liste">
				<div class="champSalaire">
					<label for="salaire">Mon salaire</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champArgentPoche">
					<label for="argentPoche">Mon argent de poche</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
			</div>
			<input type="button" value="Ajouter un revenu" onClick="ajouterListe();">
		</form>
	</div>

	<div class="blocRevenusVariables">
		<div class="titreBloc">
			<h2>Revenus variables</h2>
		</div>
		<form name="revenusVariables">
			<div id="liste">
				<div class="champAnniversaire">
					<label for="anniversaire">Mon anniversaire</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champNoel">
					<label for="noel">Noël</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
			</div>
			<input type="button" value="Ajouter un revenu" onClick="ajouterListe();">
		</form>
	</div>
	<div class="blocDepensesFixes">
		<div class="titreBloc">
			<h2>Dépenses fixes</h2>
		</div>
		<form name="depensesFixes">
			<div id="liste">
				<div class="champLogement">
					<label for="logement">Mon logement</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champAbonnements">
					<label for="noel">Mes abonnements</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champAssurances">
					<label for="assurances">Mes assurances</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champMutuelle">
					<label for="mutuelle">Ma mutuelle</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
			</div>
			<input type="button" value="Ajouter une dépense" onClick="ajouterListe();">
		</form>
	</div>
	<div class="blocDepensesVariables">
		<div class="titreBloc">
			<h2>Dépenses variables</h2>
		</div>
		<form name="depensesVariables">
			<div id="liste">
				<div class="champAlimentation">
					<label for="alimentation">Mon alimentation</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champSortiesLoisirs">
					<label for="sortiesLoisirs">Mes sorties et loisirs</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champShopping">
					<label for="shopping">Mon shopping</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champFraisScolaire">
					<label for="fraisScolaire">Mes frais scolaires</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
				<div class="champEpargne">
					<label for="epargne">Mon épargne</label>
					<div class="mois_annee">
						<label><input type="text" name=""></label>
						<select>
							<option value="€/mois">€/mois</option>
							<option value="€/an">€/an</option>
						</select><br/>
					</div>
				</div>
			</div>
			<input type="button" value="Ajouter une dépense" onClick="ajouterListe();">
		</form>
	</div>

	<div class="boutonValider">
		<input type="submit" name="submitValider">
	</div>
 
 <script type="text/javascript">
 
	function ajouterListe(){
    	var champliste = "<label><input type='text' name='champ' value='' size='10' maxlength='50'/></label><label><input type='text' name='champ' value='' size='10' maxlength='50'/></label><select><option>€/mois</option><option>€/an</option></select><input type='submit' value='Ok'/><br/>";
    	document.getElementById('liste').innerHTML += champliste;
	}
 
</script>
</body>
</html>