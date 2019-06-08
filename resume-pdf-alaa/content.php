<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" href="assets/css/bootstrap.css">
  <title>Resume</title>
  <style type="text/css">
    body {
      font-family: Helvetica !important;
    }
    .text-primary {
      color: #009ceb;
    }
    .bg-primay {
      background: #009ceb !important;
    }
    .page-wrapper .col {
      float: left;
    }
    .left-wrapper {
      width: 60%;
    }
    .right-wrapper {
      width: 40%;
      padding-left: 30px;
    }
    .top-header {
      {{ isset($avatar) ? 'padding-left: 170px; height: 150px;' : '' }}
      position: relative;
      margin-bottom: 15px;
    }
    .applicant-name {
      font-weight: bold;
    }
    .about {
      font-size: 0.85em;
    }
    .applicant-job-title {

    }
    .avatar {
      width: 150px;
      height: 150px;
      top: 0;
      left: 0;
      position: absolute;
      border-radius: 75px;
    }
    .contact-details > div{
      margin-bottom: 5px;
    }
    .font-icon {
      width: 12px;
      margin-top: 5px;
      margin-right: 10px;
    }
    .skills-list {
      margin-top: 30px;
      padding-right: 40px;
    }
    .skills-list-item {
      margin-bottom: 10px;
    }
    .skills-list-item .title {
      margin-bottom: 10px;
    }
    .skills-list-item .skill-item {
      padding-left: 15px;
      margin-bottom: 10px;
    }
    .skill-progress {
      height: 5px;
      background: #ddd;
      position: relative;
    }
    .skill-progress::before {
      top: 0;
      left: 0;
      content: '';
      width: 100%;
      height: 5px;
      display: block;
      position: absolute;
      background: #009ceb;
    }
    <?php for ($i=0; $i < 101; $i += 5) { ?>
    .skill-progress[data-progress="{{ $i }}"]::before { width: {{ $i }}%; }
    <?php } ?>
    .skill-name {
      margin-bottom: 6px;
      font-size: .9em;
    }
    .experience-list {
      margin-top: 10px;
    }
    h4.title {
      margin-bottom: 10px;
      font-size: 1.1em;
    }
    .experience-data {
      font-size: 0.9em !important;
      padding-left: 15px;
      margin-bottom: 4px;
    }
    .experience-data .small {
      margin: 0px !important;
      font-size: 0.85em !important;
    }
    .experience-data .title {
      margin-bottom: 5px;
    } 
  </style>
</head>
<body>
  <div class="page-wrapper">
    <div class="col left-wrapper">
      <div class="top-header">
        <?php if(isset($avatar)) {?>
        <img src="{{ $avatar }}" class="avatar">
        <?php } ?>
        <div class="applicant-details">
          <h3 class="applicant-name">{{ $name }}</h3>
          <h6 class="applicant-job-title text-muted">{{ $position }}</h6>
        </div>
      </div>
      <div class="text-muted text-justify about">{{ $about }}</div>
      <div class="experience-list">
        <?php foreach ($experience as $row) {?>
        <div class="experience-item">
          <h4 class="title text-primary">{{ $row['title'] }}</h4>
          <?php foreach ($row['items'] as $item) {?>
          <?php if(isset($item['hide']) && $item['hide']) { continue; }?>
          <div class="experience-data">
            <div class="lead title">
              <div>
                <span class="text-dark">{{ $item['title'] }}</span>
                <?php if(isset($item['place'])) {?><span class="text-muted"> / {{ $item['place'] }}</span><?php } ?>
              </div>
              <?php if(isset($item['description'])) {?><div class="text-muted small" style="margin-top: 10px">{{ $item['description'] }}</div><?php } ?>
              <?php if(isset($item['date'])) {?><div class="text-muted small">{{ $item['date'] }}</div><?php } ?>
            </div>
          </div>
          <?php }?>
        </div>
        <?php } ?>
      </div>
    </div>
    <div class="col right-wrapper">
      <div class="contact-details">
        <?php foreach ($contact as $row) {?>
        <div>
          <img class="font-icon" src="assets/icons/{{ $row['icon'] }}">
          <span class="text-muted">{{ $row['value'] }}</span>
        </div>
        <?php } ?>
      </div>
      <div class="skills-list">
        <?php foreach ($skills as $row) {?>
        <div class="skills-list-item">
          <h4 class="title text-primary">{{ $row['title'] }}</h4>
          <?php foreach ($row['skills'] as $skill) {?>
          <div class="skill-item">
            <div class="skill-name lead">{{ $skill['name'] }}</div>
            <div class="skill-progress" data-progress="{{ $skill['progress'] }}"></div>
          </div>
          <?php } ?>
        </div>
        <?php } ?>
      </div>
    </div>
  </div>
</body>
</html>