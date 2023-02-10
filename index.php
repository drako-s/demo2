<?php
include_once('Db.php');
include_once('Utils.php');
include_once('credentials.php');

function loadConfig() {
if(file_exists('config.ini'))
    {
      $config = parse_ini_file("config.ini");
      return array("orderID" => $config["orderID"]);
    } else
    return array();
}

$configData = loadConfig();

$content = Db::queryOne('SELECT aboutus.*, contacts.*, metatags.*, domains.*, cta.*, headlines.*, opening_time.* FROM aboutus 
          LEFT JOIN contacts ON aboutus.order_id = contacts.order_id
          LEFT JOIN metatags ON aboutus.order_id = metatags.order_id
          LEFT JOIN domains ON aboutus.order_id = domains.order_id
          LEFT JOIN cta ON aboutus.order_id = cta.order_id
          LEFT JOIN headlines ON aboutus.order_id = headlines.order_id
          LEFT JOIN opening_time ON aboutus.order_id = opening_time.order_id
          WHERE aboutus.order_id = ?', array($configData['orderID']));

$features = Db::queryAll('SELECT * FROM `features` WHERE `order_id` = ?', array($configData['orderID']));
$faqs = Db::queryAll('SELECT * FROM `faq` WHERE `order_id` = ?', array($configData['orderID']));
$services = Db::queryAll('SELECT * FROM `services` WHERE `order_id` = ?', array($configData['orderID']));
?>
<!doctype html>
<html lang="cs">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title><?= $content['meta_title'] ?></title>
  <meta name="description" content="<?= $content['meta_description']?>">
  <meta name="keywords" content="<?= $content['meta_keywords']?>">
  	<!-- For Facebook -->
	<meta property="og:title" content="<?= $content['og_title']?>" /> <!-- max. 88 characters-->
	<meta property="og:type" content="<?= $content['og_description']?>" /> 
	<meta property="og:image" content="images/drako_facebook_og.png">
	<meta property="og:url" content="https://<?= $content['domain']?>" />
	<meta property="og:description" content="Začněte s levným webem a navyšujte dle potřeby!" /> <!-- around 200 characters-->
	<meta property="og:locale" content="cs_CZ" />

	<link rel="canonical" href="https://<?= $content['domain']?>" />

  <!-- font awesome 6 free -->
  <script src="https://kit.fontawesome.com/a4fa5c84b6.js" crossorigin="anonymous"></script>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- Poppins font from Google -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/app.css">

  
</head>
<!-- Google tag (gtag.js) -->
<?= $content['g_analytics'] ?>
<!-- End Google tag (gtag.js) -->
<body>
  <!--Hero ====================================== -->
  <header class="container-fluid" id="hero">
    <nav class="navbar navbar-expand-lg fixed-top shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="/"><i class="fa-solid fa-broom pe-2"></i><?= $content['c_brand'] ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
          <div id="navbar-toggler-icon">
            <i class="fas fa-bars"></i>
          </div>         
        </button>
        <div class="collapse navbar-collapse justify-content-end gap-3" id="navbarScroll">
          <ul class="navbar-nav my-2 my-lg-0 gap-3">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#hero">Úvod</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#aboutus">O nás</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#product">Služby</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#pricing">Ceník</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#faq">FAQ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact-us">Kontakt</a>
            </li>
          </ul>
          <div class="navbar-social-icons">
          <ul class="d-flex list-unstyled m-0 p-0">
            <?php if(!empty($content['c_facebook'])) : ?>
              <li class="mx-2">
              <a href="<?=$content['c_facebook']?>" class="block-44__link m-0">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_twitter'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_twitter'] ?>" class="block-44__link m-0">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_instagram'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_instragram'] ?>" class="block-44__link m-0">
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_youtube'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_youtube'] ?>" class="block-44__link m-0">
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_discord'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_discord'] ?>" class="block-44__link m-0">
                <i class="fab fa-discord"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_linkedin'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_linkedin'] ?>" class="block-44__link m-0">
                <i class="fab fa-linkedin"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_mastodon'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_mastodon'] ?>" class="block-44__link m-0">
                <i class="fab fa-mastodon"></i>
              </a>
            </li>
            <?php endif; ?>
          </ul>
          </div>
        </div>
      </div>
    </nav>   

  </header>
<div class="hero">
  <div class="container overflow-hidden pt-5">
    <div class="row g-5">
      <div class="col-md-8 col-lg-6 d-flex flex-column align-items-start justify-content-center gap-3 pt-5">
        <h1>
        <?= $content['hero_title']?>
        </h1>
        <p class="subheadline">
        <?= $content['hero_subtitle']?>
        </p>
        <p>
          <?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?>
        </p>
        
      </div>
      <div class="col-md-4 col-lg-6 pt-lg-5">
        <div class="d-flex align-items-center justify-content-center h-100">
          <img src="https://www.stanislav-drako.cz/public/img/abstract.svg" class="hero__img w-100">
        </div>
      </div>
    </div>
  </div>
  <div class="hero-shape">
    <div class="custom-shape">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <defs>
          <linearGradient id="gradient">
            <stop offset="0%" stop-color="#F858A9" />
            <stop offset="100%" stop-color="#EB7B11" />
          </linearGradient>
        </defs>
            <path fill="url(#gradient)" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
  </div>
</div>
 

  <!-- ===================================== -->

<section id="aboutus" class="pt-5">
    <div class="container overflow-hidden">
      <div class="row g-5">
      <!-- HEADER -->
      <div class="col-md-4 col-lg-6 order-2 order-md-0">
                <!-- IMAGE -->
        <div class="d-flex justify-content-center align-items-center h-100">
          <img src="https://www.stanislav-drako.cz/public/img/abstract2.svg" class="w-75 zindex-3">
        </div>
      </div>
      <div class="col-md-8 col-lg-6 d-flex flex-column justify-content-center align-items-end order-1 pt-5">
        <p class="subheadline"><?= $content['about_subtitle'] ?></p>
        <h2 class="text-end">
          <?= $content['about_title'] ?></h2>
        <p class="text-end">
            <?= $content['about_content'] ?>
        </p>
        <p class="mt-3"><?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?></p>
      </div>
    </div>
  </div>
  <div class="hero-shape">
    <div class="custom-shape">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <defs>
          <linearGradient id="gradient2">
            <stop offset="0%" stop-color="#FFFFFF" />
            <stop offset="100%" stop-color="#FFFFFF" />
          </linearGradient>
        </defs>
            <path fill="url(#gradient2)" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
  </div>
</section>

<section id="product">
  <div class="container overflow-hidden">
  <div class="row d-flex justify-content-center pb-5 g-5">
    <div class="d-flex justify-content-center">
      <div class="text-center">
        <h2><?= $content['feat_headline'] ?></h2>
        <p class="subheadline">
          <?= $content['feat_subheadline'] ?>
        </p>
      </div>
    </div>
      <!-- Feature -->
      <?php foreach($features as $f) : ?>
      <div class="col-md-6 col-lg-4">
        <div class="d-flex flex-column gap-4 h-100">
          <div class="align-self-center">
            <span class="features-icon">
              <i class="fa-solid fa-thumbtack"></i>
            </span>
          </div>            
          <div>
            <h3 class="text-center"><?= $f['f_title'] ?></h3>
            <p class="text-center">
            <?= $f['f_content'] ?>
            </p>
          </div>
        </div>          
      </div>
      <?php endforeach ; ?>

    </div>
  </div>
  <div class="hero-shape">
    <div class="custom-shape">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <defs>
          <linearGradient id="gradient3">
            <stop offset="0%" stop-color="#F5F5F5" />
            <stop offset="100%" stop-color="#F5F5F5" />
          </linearGradient>
        </defs>
            <path fill="url(#gradient3)" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
  </div>
</section>
  <!-- ===================================== -->
  <section id="pricing">
    <div class="container pb-5 overflow-hidden">
      <div class="d-flex flex-column align-items-center pb-5">
        <div class="text-center">
          <h2><?= $content['price_headline'] ?></h2>
        </div>
          <p class="subheadline">
            <?= $content['price_subheadline'] ?>
          </p>
      </div>
      <div class="row justify-content-center py-5 g-5">

      <?php foreach($services as $s) : ?>
          <div class="col-md-6 col-lg-4">
            <div class="price-card text-center d-flex flex-column justify-content-between gap-2 h-100 py-5">
              <span class="pricing-icon">
                <i class="fa-solid fa-sack-dollar"></i>
              </span>
              <h3><?= $s['services_title']?></h3>
              <p>
                <?= $s['services_content']?>
              </p>
              <span class="price"><?= $s['services_price']?></span>
            </div>            
          </div>
        <?php endforeach; ?>

      </div>
    </div>
    <div class="hero-shape">
    <div class="custom-shape">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <defs>
          <linearGradient id="gradient5">
            <stop offset="0%" stop-color="#FFFFFF" />
            <stop offset="100%" stop-color="#FFFFFF" />
          </linearGradient>
        </defs>
            <path fill="url(#gradient5)" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
  </div>
  </section>

  <section id="cta">
  <div class="container-fluid py-5 overflow-hidden">
    <div class="row g-5">
      <div class="col-12">
        <div class="d-flex flex-column justify-content-center align-items-center gap-3">
          <div class="col-lg-6">
            <h2 class="text-center"><?= $content['cta_title'] ?></h2>
            <p class="text-center"><?= $content['cta_subtitle'] ?></p>
          </div>
          <p><?= Utils::buttonCTA($configData['orderID'], $content['web_target']) ?></p>
        </div>

      </div>
    </div>
  </div>
  <div class="hero-shape">
    <div class="custom-shape">
        <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <defs>
          <linearGradient id="gradient4">
            <stop offset="0%" stop-color="#F858A9" />
            <stop offset="100%" stop-color="#EB7B11" />
          </linearGradient>
        </defs>
            <path fill="url(#gradient4)" d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z" class="shape-fill"></path>
        </svg>
    </div>
  </div>
</section>

  <!-- =================================== -->
<section id="faq" class="block-20 space-between-blocks">
    <div class="container overflow-hidden">
      <!-- HEADER -->
      <div class="d-flex flex-column align-items-center text-center py-5 ">
        <p>FAQ</p>
        <div class="text-center">
          <h2><?= $content['faq_headline'] ?></h2>
        </div>
        <p class="subheadline">
        <?= $content['faq_subheadline'] ?>
        </p>
      </div>
      <div class="row g-5">
        <div class="col-lg-6">
        <img class="w-100" src="https://www.stanislav-drako.cz/public/img/abstract3.svg">
        </div>
        <div class="col-lg-6 pb-5">
          <div class="d-flex align-items-start h-100">
          <div class="accordion accordion-flush w-100" id="accordionExample">
                <?php foreach($faqs as $faq) : ?>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="heading<?= $faq['id'] ?>">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq<?= $faq['id'] ?>" aria-expanded="false" aria-controls="faq<?= $faq['id'] ?>">                                                        
                        <?= $faq['faq_question'] ?>  
                    </h2>
                    <div id="faq<?= $faq['id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $faq['id'] ?>" data-bs-parent="#accordionExample">
                        <div class="accordion-body d-flex card-1__paragraph">
                        <?= $faq['faq_answer'] ?>
                        
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
          </div>
        </div>
      </div>
      
    </div>
</section>

  <!-- ======================================== -->


  <!-- =================================== -->

  <section id="contact-us">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100">
          <div class="col-12 col-md-8 d-flex flex-column gap-3">
            <h2><?= $content['contact_headline'] ?></h2>
            <p class="subheadline">
            <?= $content['contact_subheadline'] ?>
            </p>
            <div>
              <h6 class="fw-bold"><?= $content['c_person'] ?></h6>
              <p class="d-flex flex-column">
                <span><?= $content['c_address'] ?></span>
                <?php if(!empty($content['c_ico'])) : ?>
                <span><?= 'IČO: ' . $content['c_ico'] ?></span>
                <?php endif; ?>
                <?php if(!empty($content['c_dic'])) : ?>
                <span><?= 'DIČ: ' . $content['c_dic'] ?></span>
                <?php endif; ?>
                <?php if(!empty($content['c_datovka'])) : ?>
                <span><?= 'Datová schránka: ' . $content['c_datovka'] ?></span>
                <?php endif; ?>
              </p>
            </div>
            <div class="mb-5">
              
              <p class="d-flex flex-column">
                <?php if(!empty($content['c_phone'])) : ?>
                <span>
                  <a href="tel:<?= $content['c_phone'] ?>"><i class="fas fa-phone"></i><span class="mx-2"><?= $content['c_phone'] ?></span></a>
                </span>
                <?php endif; ?>
                <?php if(!empty($content['c_email'])) : ?>
                <span>
                  <a href="mailto:<?= $content['c_email'] ?>"><i class="fas fa-envelope"></i><span class="mx-2"><?= $content['c_email'] ?></span></a>
                </span>
                <?php endif; ?>
              </p>
            </div>
          </div>
        </div>
        <div class="col-lg-6 open-hour">
        <?php if(!$content['nonstop']) :  ?> 
          <div class="d-flex flex-column justify-content-center align-items-center h-100 p-4">  
          <div class="col-12 col-md-8 d-flex flex-column gap-3">                          
          <div class="d-flex justify-content-between">
              <span class="headline-color">Pondělí: </span>
              <?php if($content['mon_hour_start']) : ?>
              <div class="d-flex gap-2">
                  <div><span><?= $content['mon_hour_start'] ?></span> : <span><?= $content['mon_min_start'] ?></span></div>
                  <div> - <span><?= $content['mon_hour_end'] ?></span> : <span><?= $content['mon_min_end'] ?></span></div>
              </div>
              <?php else : ?>
                <div><span class="text-danger">Zavřeno</span></div>
              <?php endif; ?>
          </div> 
          <div class="d-flex justify-content-between">
              <span class="headline-color">Úterý: </span>
              <?php if($content['tue_hour_start']) : ?>
              <div class="d-flex gap-2">
                  <div><span><?= $content['tue_hour_start'] ?></span> : <span><?= $content['tue_min_start'] ?></span></div>
                  <div> - <span><?= $content['tue_hour_end'] ?></span> : <span><?= $content['tue_min_end'] ?></span></div>
              </div>
              <?php else : ?>
                <div><span class="text-danger">Zavřeno</span></div>
              <?php endif; ?>
          </div>
          <div class="d-flex justify-content-between">
              <span class="headline-color">Středa: </span>
              <?php if($content['wen_hour_start']) : ?>
              <div class="d-flex gap-2">
                  <div><span><?= $content['wen_hour_start'] ?></span> : <span><?= $content['wen_min_start'] ?></span></div>
                  <div> - <span><?= $content['wen_hour_end'] ?></span> : <span><?= $content['wen_min_end'] ?></span></div>
              </div>
              <?php else : ?>
                <div><span class="text-danger">Zavřeno</span></div>
              <?php endif; ?>
          </div>     
          <div class="d-flex justify-content-between">
              <span class="headline-color">Čtvrtek: </span>
              <?php if($content['thu_hour_start']) : ?>
              <div class="d-flex gap-2">
                  <div><span><?= $content['thu_hour_start'] ?></span> : <span><?= $content['thu_min_start'] ?></span></div>
                  <div> - <span><?= $content['thu_hour_end'] ?></span> : <span><?= $content['thu_min_end'] ?></span></div>
              </div>
              <?php else : ?>
                <div><span class="text-danger">Zavřeno</span></div>
              <?php endif; ?>
          </div>
          <div class="d-flex justify-content-between">
              <span class="headline-color">Pátek: </span>
              <?php if($content['fri_hour_start']) : ?>
              <div class="d-flex gap-2">
                  <div><span><?= $content['fri_hour_start'] ?></span> : <span><?= $content['fri_min_start'] ?></span></div>
                  <div> - <span><?= $content['fri_hour_end'] ?></span> : <span><?= $content['fri_min_end'] ?></span></div>
              </div>
              <?php else : ?>
                <div><span class="text-danger">Zavřeno</span></div>
              <?php endif; ?>
          </div> 
          <div class="d-flex justify-content-between">
              <span class="headline-color">Sobota: </span>
              <?php if($content['sat_hour_start']) : ?>
              <div class="d-flex gap-2">
                  <div><span><?= $content['sat_hour_start'] ?></span> : <span><?= $content['sat_min_start'] ?></span></div>
                  <div> - <span><?= $content['sat_hour_end'] ?></span> : <span><?= $content['sat_min_end'] ?></span></div>
              </div>
              <?php else : ?>
                <div><span class="text-danger">Zavřeno</span></div>
              <?php endif; ?>
          </div>                                                                     
          <div class="d-flex justify-content-between">
              <span class="headline-color">Neděle: </span>
              <?php if($content['sun_hour_start']) : ?>
              <div class="d-flex gap-2">
                  <div><span><?= $content['sun_hour_start'] ?></span> : <span><?= $content['sun_min_start'] ?></span></div>
                  <div> - <span><?= $content['sun_hour_end'] ?></span> : <span><?= $content['sun_min_end'] ?></span></div>
              </div>
              <?php else : ?>
                <div><span class="text-danger">Zavřeno</span></div>
              <?php endif; ?>
          </div> 
          </div>
          </div>
          <?php endif; ?>
      </div>
      </div>
    </div>
  </div>

  <!-- =================================== -->

  <div class="footer">
    <div class="container">
      <div class="row flex-column flex-md-row px-2 pt-3 justify-content-center">
        <div class="col-12 col-md-4">
          <ul class="d-flex list-unstyled p-0">
            <?php if(!empty($content['c_facebook'])) : ?>
              <li class="mx-2">
              <a href="<?=$content['c_facebook']?>">
                <i class="fab fa-facebook"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_twitter'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_twitter'] ?>">
                <i class="fab fa-twitter"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_instagram'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_instragram'] ?>" >
                <i class="fab fa-instagram"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_youtube'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_youtube'] ?>" >
                <i class="fab fa-youtube"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_discord'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_discord'] ?>" >
                <i class="fab fa-discord"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_linkedin'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_linkedin'] ?>" >
                <i class="fab fa-linkedin"></i>
              </a>
            </li>
            <?php endif; ?>
            <?php if(!empty($content['c_mastodon'])) : ?>
            <li class="mx-2">
              <a href="<?= $content['c_mastodon'] ?>" >
                <i class="fab fa-mastodon"></i>
              </a>
            </li>
            <?php endif; ?>
          </ul>
          
        </div>
        <div class="col-md-8">
          <p class="block-41__copyrights">&copyCopyright 2022 - <?= date('Y')?>. Vytvořil s láskou <a href="https://www.stanislav-drako.cz">Stanislav Drako</a></p>
        </div>
        
      </div>
    </div>
</section>

  <!-- =================================== -->



  <script src="assets/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery-3.6.3.min.js"></script>

  <script src="assets/js/app.js"></script>


</body>

</html>
