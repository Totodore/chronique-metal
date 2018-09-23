<?php 
    include '../../src/html/system/init.php';

    $id = $_GET['id'];
    $type = $_GET['type'];

    $bdd->query('DELETE from '.$type.' WHERE ID='.$id);
    echo "Supression terminée, vous allez être redirigé dans 2sec...";
?>
<script>
    setTimeout(function() {window.location.href = "/admin/post_operations/"}, 2000);
</script>