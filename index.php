<?php
$pdfText = $statusMsg = '';
$status = '*ERROR*';

// If the form is submitted
if (isset($_POST['submit'])){
  // If file is selected
  if (!empty($_FILES["pdf_file"]["name"])) {
    // File upload path
    $fileName = basename($_FILES["pdf_file"]["name"]);
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION);

    // Allow certain file formats
    $allowTypes = array('pdf');
    if (in_array($fileType, $allowTypes)){
      // Include autolaoder file
      include 'vendor/autoload.php';

      // Initialize and load PDF Parser Library
      $parser = new \Smalot\PdfParser\Parser(); 

      // Source PDF file to extract text
      $file = $_FILES["pdf_file"]["tmp_name"];

      // Parse PDF file using Parser Library
      $pdf = $parser->parseFile($file);

      // Extract text from PDF
      $text = $pdf->getText();

      // Add line break
      $pdfText = nl2br($text);
    } else {
      $statusMsg = '<p>Sorry, only PDF file is allowed.</p>'; 
    }
  } else {
    $statusMsg = '<p>Please select a PDF file to extract text.</p>'; 
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" sizes="16x16 32x32 64x64 96x96 512x512" href="https://avatars.githubusercontent.com/u/31607014?v=4">
    <title>Extract PDF Text</title>
    <!-- bulma css v1.0.2 -->
    <link rel="stylesheet" href="css/bulma.min.css"> 
    <!-- Font Awesome CDN -->
    <script src="https://kit.fontawesome.com/8111e86755.js" crossorigin="anonymous"></script>
  </head>
  <body style="background-color: #352F36;">  <!-- BODY -->

<!-- CONTENT -->
 <section class="section">
    <div class="container fluid has-text-centered">

      <h1 class="title is-size-1">Extract PDF Text</h1>

      <br/>

      <div class="columns is-centered">

          <form action="" method="post" enctype="multipart/form-data">

            <div id="file-js-example" class="file is-warning has-name is-large">
              <label class="file-label">
                <input class="file-input" type="file" name="pdf_file" required/>
                <span class="file-cta">
                  <span class="file-icon">
                    <i class="fas fa-upload"></i>
                  </span>
                  <span class="file-label"> Choose a file </span>
                </span>
                <span class="file-name"> No file selected </span>
              </label>
            </div>

            <div class="buttons is-centered">
              <input type="submit" name="submit" class="button is-large is-rounded is-focused" value="Extract Text">
            </div>
        </form>
         
      </div>
    </div>
 </section>

 <section class="">
  <div class="container pl-4 pr-4">
    <div class="control is-normal is-loading">
      <article class="message is-success is-small">
        <div class="message-header">
          <p>Extracted Text Result <?php if (!empty($statusMsg)){ echo $status; echo $statusMsg;}?></p> <!-- Status Message -->
        </div>
        <div class="message-body">
          <?php if (!empty($pdfText)){
            echo $pdfText;
          }?>
        </div>
      </article>
    </div>
  </div>
</section>

<section class="section">
  <div class="container has-text-centered">
    <h1 class="subtitle">by <a href="https://github.com/zenpao">zenpao</a> <i class="fa-regular fa-heart" style="color: #ff0000;"></i>
       <i class="fa-regular fa-hand-peace" style="color: #FFD43B;"></i></h1>
    <h1 class="is-size-7 has-text-weight-light">CodexWorld (2024). <span class="is-italic">Extract Text from PDF using PHP</span> [Source Code]. <a href="https://www.codexworld.com/extract-text-from-pdf-using-php/">https://www.codexworld.com/extract-text-from-pdf-using-php/</a></h1>
  </div>
</section>
<!-- CONTENT -->

<!-- FOOTER -->
<!-- FOOTER -->

<!-- JAVASCRIPT -->
    <script src="js/bulma.navbar.js"></script>   
    <script src="js/bulma.modal.js"></script>    
    <script src="js/bulma.tab.js"></script>
    <script src="js/bulma.file.js"></script> 
  </body> <!-- BODY -->
</html>