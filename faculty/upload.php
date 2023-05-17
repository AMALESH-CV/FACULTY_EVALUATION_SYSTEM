<?php include('db_connect.php');
function ordinal_suffix1($num){
    $num = $num % 100; // protect against large numbers
    if($num < 11 || $num > 13){
         switch($num % 10){
            case 1: return $num.'st';
            case 2: return $num.'nd';
            case 3: return $num.'rd';
        }
    }
    return $num.'th';
}
$astat = array("Not Yet Started","On-going","Closed");
 ?>

<div class="col-12">
    <div class="card">
      <div class="card-body">
        Welcome <?php echo $_SESSION['login_name'] ?>!
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5><b>Academic Year: <?php echo $_SESSION['academic']['year'].' '.(ordinal_suffix1($_SESSION['academic']['semester'])) ?> Semester</b></h5>
            <h6><b>Evaluation Status: <?php echo $astat[$_SESSION['academic']['status']] ?></b></h6>
          </div>
        </div>
      </div>
    </div>
</div>


<div class="container d-flex flex-wrap">
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        FDP DATA
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=fdp">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        TEACHING HOURS
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=teaching_hours">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        ADD ON COURSE TEACHING
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=add_on_course_teaching">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container d-flex flex-wrap">
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        SYLLABUS ENRICHMENT
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=syllabus_enrichment">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        INNOVATIVE TEACHING
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=innovative_teaching">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        EXAM DUTY
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=exam_duty">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container d-flex flex-wrap">
  <div class="col-4">
    <div class="card">
      <div class="card-body">
        STUDENT SUPPORT
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=student_support">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        CONTRIBUTION TO INSTITUTES GROWTH
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=institution_growth">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        DISCIPLINE-PUNCTUALITY
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=punctuality">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-4">
    <div class="card">
      <div class="card-body">
        RESULTS
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=exam_results">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="col-4">
    <div class="card">
      <div class="card-body">
        ADMISSION SUPPORT
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=admission_support">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="col-4">
    <div class="card">
      <div class="card-body">
        DEPARTMENT MAGAZINE
        <br>
        <div class="col-md-5">
          <div class="callout callout-info">
            <h5></h5>
            <h6><a href="./index.php?page=department_magazine">Click to Upload Data
            </a></h6>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>



