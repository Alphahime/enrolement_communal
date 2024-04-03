<?php
interface Crud {
    public function addMember($nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut, $adresse);
    public function readMember();
    public function updateMember($id, $nom, $prenom, $tranche_age, $sexe, $situation_matrimoniale, $statut, $adresse);
    public function deleteMember($id);
}
?>
