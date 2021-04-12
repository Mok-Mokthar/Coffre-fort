<?php 
  include 'partials/header.php';
  include './treatment/downloads.php'; ?>
    

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>Download files</title>
</head>
<body>

<table>
  <thead>
      <th>ID</th>
      <th>Nom du fichier</th>
      <th>Taille</th>
      <th>Nombre de Donwloads</th>
      <th>Action</th>
  </thead>
  <tbody>
    <?php foreach ($files as $file): ?>
      <tr>
        <td><?php echo $file['id']; ?></td>
        <td><?php echo $file['name']; ?></td>
        <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
        <td><?php echo $file['downloads']; ?></td>
        <td class="download"><a href="downloads.php?file_id=<?php echo $file['id'] ?>">Download</a></td>
      </tr>
    <?php endforeach;?>

  </tbody>
</table>

<div class="accueil">
  <a href="./">accueil</a>
  <br>
</div>
  
</body>
</html>

<?php include 'partials/footer.php' ?>