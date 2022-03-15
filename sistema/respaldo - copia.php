<?php
include_once "includes/header.php";

error_reporting(E_ALL);
ini_set('display_errors', '1');    // 0 or 1 set 1 if unable to download database it will show all possible errors
ini_set('max_execution_time', 0);  // setting 0 for no time limit

define('BACKUP_DIR', './myBackups' ) ;
$username='root';
$password='root';
 $_SESSION['login']=true;

if(isset($_SESSION['login'])){
if(isset($_GET['task'])&& $_GET['task']=='clear'){
    $file_name=$_GET['file'];
    $file=BACKUP_DIR.DIRECTORY_SEPARATOR.$file_name;
    if(file_exists($file)){ if(unlink($file)) $rmsg="$file_name Deleted successfully";}
    else { $rmsg="<b>$file_name </b>Not found already removed";}
}

if(isset($_REQUEST['submit'])){
##################### 
//CONFIGURATIONS  
#####################
// Define the name of the backup directory
$host=trim($_POST['host']);
$user=trim($_POST['user']);
$password=trim($_POST['password']);
$database=trim($_POST['database']);
//if(!empty($host)&&!empty($user)&&!empty($password)&&!empty($database))
// Define  Database Credentials
define('HOST', $host ) ; 
define('USER', $user ) ; 
define('PASSWORD', $password ) ; 
define('DB_NAME', $database ) ; 
/*
Define the filename for the sql file
If you plan to upload the  file to Amazon's S3 service , use only lower-case letters 
*/
$fileName = 'copiarespaldo(' . date('d-m-Y') . ').sql' ; 
// Set execution time limit
if(function_exists('max_execution_time')) {
if( ini_get('max_execution_time') > 0 ) 	set_time_limit(0) ;
}

// Check if directory is already created and has the proper permissions
if (!file_exists(BACKUP_DIR)) mkdir(BACKUP_DIR , 0700) ;
if (!is_writable(BACKUP_DIR)) chmod(BACKUP_DIR , 0700) ; 

// Create an ".htaccess" file , it will restrict direct accss to the backup-directory . 
$content = 'Allow from all' ; 
$file = new SplFileObject(BACKUP_DIR . '/.htaccess', "w") ;
$file->fwrite($content) ;

$mysqli = new mysqli(HOST , USER , PASSWORD , DB_NAME) ;
if (mysqli_connect_errno())
{
   printf("Connect failed: %s", mysqli_connect_error());
   exit();
}
 // Introduction information
$return='';
 $return .= "--\n";
$return .= "-- A Mysql Backup System \n";
$return .= "--\n";
$return .= '-- Export created: ' . date("Y/m/d") . ' on ' . date("h:i") . "\n\n\n";
$return = "--\n";
$return .= "-- Database : " . DB_NAME . "\n";
$return .= "--\n";
$return .= "-- --------------------------------------------------\n";
$return .= "-- ---------------------------------------------------\n";
$return .= 'SET AUTOCOMMIT = 0 ;' ."\n" ;
$return .= 'SET FOREIGN_KEY_CHECKS=0 ;' ."\n" ;
$tables = array() ; 
// Exploring what tables this database has
$result = $mysqli->query('SHOW TABLES' ) ; 
// Cycle through "$result" and put content into an array
while ($row = $result->fetch_row()) 
{
    $tables[] = $row[0] ;
}
// Cycle through each  table
foreach($tables as $table)
{ 
    // Get content of each table
    $result = $mysqli->query('SELECT * FROM '. $table) ; 
    // Get number of fields (columns) of each table
    $num_fields = $mysqli->field_count  ;
    // Add table information
    $return .= "--\n" ;
    $return .= '-- Tabel structure for table `' . $table . '`' . "\n" ;
    $return .= "--\n" ;
    $return.= 'DROP TABLE  IF EXISTS `'.$table.'`;' . "\n" ; 
    // Get the table-shema
    $shema = $mysqli->query('SHOW CREATE TABLE '.$table) ;
    // Extract table shema 
    $tableshema = $shema->fetch_row() ; 
    // Append table-shema into code
    $return.= $tableshema[1].";" . "\n\n" ; 
    // Cycle through each table-row
    while($rowdata = $result->fetch_row()) 
    { 
        // Prepare code that will insert data into table 
        $return .= 'INSERT INTO `'.$table .'`  VALUES ( '  ;
        // Extract data of each row 
        for($i=0; $i<$num_fields; $i++)
        {   
        $return .= '"'.$mysqli->real_escape_string($rowdata[$i]) . "\"," ;
        }
        // Let's remove the last comma 
        $return = substr("$return", 0, -1) ; 
        $return .= ");" ."\n" ;
    } 
 $return .= "\n\n" ; 
}
// Close the connection
$mysqli->close() ;
$return .= 'SET FOREIGN_KEY_CHECKS = 1 ; '  . "\n" ; 
$return .= 'COMMIT ; '  . "\n" ;
$return .= 'SET AUTOCOMMIT = 1 ; ' . "\n"  ; 
//$file = file_put_contents($fileName , $return) ; 
$zip = new ZipArchive() ;
$resOpen = $zip->open(BACKUP_DIR . '/' .$fileName.".zip" , ZIPARCHIVE::CREATE) ;
if( $resOpen ){
$zip->addFromString( $fileName , "$return" ) ;
    }
$zip->close() ;
$fileSize = get_file_size_unit(filesize(BACKUP_DIR . "/". $fileName . '.zip')) ; 
// Function to append proper Unit after file-size . 
}

?>

    <div class="main">
                    <div class="overlay"><div class="overlay-load"><div class="overlay-msg">
                     Por favor espere mientras la copia de la base de datos se genere.
                     No cierre ninguna ventana.       
                </div></div></div>
        <fieldset><legend><h2>Base de datos de respaldo</h2></legend>
            <form name="backup" id="backup" method="post">
                <div><label>Host:</label><input type="text" name="host" value="localhost" /></div>
                <div class="cls"></div>
                <div><label>Nombre base de datos:</label><input type="text" name="database" value="dbsacramentos" /></div>
                <div class="cls"></div>
                <div><label>Nombre de usuario de base de datos:</label><input type="text" name="user" value="root" /></div>
                <div class="cls"></div>
                <div><label>Contraseña de base de datos:</label><input type="text" name="password" value="" /></div>
                <div class="cls"></div>
                <div style="text-align: center;margin-top: 50px"><input onclick="vky(this)" type="submit" id="getdb" name="submit" value="Generar copia" /></div>
                <div class="cls"></div>
            </form>
        </fieldset>
    </div> 
    <script type="text/javascript">
    function vky(x){
        x.value='Wait processing..';
        document.getElementsByClassName("overlay")[0].style.display="block";
    }
    </script>
    <div class="backup_list">
        <div class=""><?php echo isset($rmsg)?$rmsg:''; ?></div>
        <?php echo display_download(BACKUP_DIR); ?>
    </div>   
</div>
<?php }else{ 
?>


<?php } ?>
<style type="text/css">
/* HTML5 display-role reset for older browsers */

body {line-height: 1;}
ol, ul {list-style: none;}
blockquote:before, blockquote:after,table {	border-collapse: collapse;border-spacing: 0;}
fieldset legend{margin-left: 20px;}
fieldset legend h2{}
form{margin: 25px;}
.cls{clear:both;border-bottom: 0px;padding: 0px}
form div{border-bottom: dotted 1px #ccc;padding: 15px;}
h2{font-size: 14px;font-weight: bold}
.backup_main{font-size: 12px;font-family: Helvetica ;width:1040px;margin:auto}
.backup_list{ background: #f9f9f9;width:500px;min-height: 410px;height: auto; padding: 10px;float:left }
.main{ position:relative; background: #f9f9f9;width:500px;height: auto; padding: 10px;font-size: 12px;font-family: verdana;float:left }
fieldset{border:solid 1px #ccc;}
div > label{font-weight: bold;width:150px;display: inline-block}
input[type="submit"]{width: 150px;cursor: pointer;height: 35px;font-size: 14px;border: 1px #ccc solid; -moz-transition: all 0.5s ease-out; -o-transition: all 0.5s ease-out; -webkit-transition: all 0.5s ease-out; -ms-transition: all 0.5s ease-out; }
input[type="submit"]:hover{ background: #000; color:#fff }
table{width:500px;margin-bottom: 100px;border: solid 1px #ccc;border-collapse: collapse}
table > thead > tr > th {ext-align: left;border-bottom: 1px #ccc solid;border-right: 1px #ccc solid;}
table > tbody > tr > td {ext-align: left;border-bottom: 1px #ccc solid;border-right: 1px #ccc solid;height: 20px;line-height: 20px;padding:5px}
table > tbody > tr > td img:hover {width:14px;height: 14px; -moz-transition: all 0.5s ease-out; -o-transition: all 0.5s ease-out; -webkit-transition: all 0.5s ease-out; -ms-transition: all 0.5s ease-out; }
a.tooltips {  position: relative;  display: inline;}
a.tooltips span {position: absolute;width:140px;color: #000000;background: #FFFFFF;border: 2px solid #CCCCCC;height: 32px;line-height: 32px;text-align: center;visibility: hidden;border-radius: 6px;box-shadow: 0px 0px 7px #808080;}
a.tooltips span:before {content: '';position: absolute;top: 100%;left: 50%;margin-left: -12px;width: 0; height: 0;border-top: 12px solid #CCCCCC;border-right: 12px solid transparent;border-left: 12px solid transparent;}
a.tooltips span:after {content: '';position: absolute;top: 100%;left: 50%;margin-left: -8px;width: 0; height: 0;border-top: 8px solid #FFFFFF;border-right: 8px solid transparent;border-left: 8px solid transparent;}
a:hover.tooltips span {visibility: visible;opacity: 1;bottom: 30px;left: 50%;margin-left: -76px;z-index: 999;}
.logout{text-align: right;width:100%;height: 25px;background: #1A1111;line-height: 25px;}
.logout a{color:#fff;margin-right: 50px;}
/*.overlay{position: absolute;width:100%;height: 100%;background: red;opacity: .50;top:0px;left: 0px;display: none;}*/
.overlay {display: none;position: absolute;width: 100%;height: 100%;top: 0px;left: 0px;background: #ccc;z-index: 1001;opacity: .95;}
.overlay-load {width: 350px;height: 100px;margin: auto;top: 0px;bottom: 0px;position: absolute;left: 0px;right: 0px;
           border: solid 1px #060522;text-align: center;
           background: #fff url(data:image/gif;base64,R0lGODlhPAAHAKUAABweJHSSRKTKVExSTIS2PPz+/Cw2JLzWfKyurKzOZIy+PDxGNGRuTKS+TCwuJKzSVJzGRKyqrDw+RLTWbGR6PKTGRCQmJHyqPKzOTJSuXDQ+LMTehLTSbERKRJzGVBwiJISWXKTOXFxmRDQ6LLzadDxCRGRyRCwyJKzSXJzGTGR6RJS2VLTSdP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAACH/C05FVFNDQVBFMi4wAwEAAAAh+QQIBgAAACwAAAAAPAAHAAAGT8ACgsEQOQDIpHLJbDqfTEmkEKFgNqSGAcrtepmIQWVyEKBA37S6KdGkOAJIIrOu1zurkMKTUNn/XiMRCxcEHgEWgIpPUxEdJ0eLkkonU0EAIfkECAYAAAAsAAAAADwABwCGHB4kfKo8xNp8nMZEtNJMRFY0ND4spM5MrKqsjL48tNJsZHJERE40pM5cnLpULDIknMZUvNpslL5EXG40PEY0vNZ8PD5ErM5MtNZsdIpErM5cLDYkpMZclMJEJCYklLZU/P78pMZEtNJkZHo8TFJMZG5MrNJUrNJcpMpUHCIkhLY8xN6EnMZMtNJUTFo8PEI0rK6sjL5EtNJ0ZHJMREpEnMJMLDIsvNp8lL5MXG48PEJErM5UtNZ0rM5kLDYslMJMpMpc////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB4OAIDAlJTMTOSU5EyUMAI6PkJGSk5SVFgggCCM7KxEXAgImESstGZWnqKmQMCQhGBUoJjc7FxUnKBgvqru8jxYGLAooNSI9HRo9LCgKLr3OqjQfQAksPTEdJxAxQBwPz9+UBggUASpAPyo1ECo4DgXg8JGYCDQPPg/2Gw8bKfH+NpgCAQAh+QQIBgAAACwAAAAAPAAHAIYcGiR8mkykzkz8/vy81nSEtjxcZkyszmScwkw0Piy00kyMvjxkejycxkQkLiS01mSszkzE3oRcbjTE2nxESkSUvkScxlRkbkSsqqy81ny00mQsNiSszlyUtlQ8RjS01lyUwkRkckQcIiR8qjy82myMukSkvmQ8PkS01lSkxkQsMiS01nSs0lSkylS00nQcHiSkzlyEujys0mSkwky00lSMvkR0ikScxky01myszlRcbjxMUkyUvkxkbkysrqy82ny00mwsNiys0lyUwkxkckyUqmS82nQ8QkQsMiykylz///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH0IADPj0XRBI6PToShIsXEhcGKgAvk5WUl5aZmJuakycYAxgMOREELBMTLCQRNCgRDwo/RjMeL5e3k7i2ury5ubs+Oyk4BAI5PzkQBDICK8UyyDlFvrbUvLvY2dm/Jwk3QEkIGgcgHDI3LUA3DS4wCDImANbzmPL29/jy9SIUHUkLNw7UACEDQY0kSWq0+IfggA1tECNKlJgAg4cRBZIMKWDBQgEeSWKUSMgxgIN8KO9xWpnJ3gsfoSioCKLCwYYNNnHeVMHz1sRt1YL2wlZxQCAAIfkECAYAAAAsAAAAADwABwCGHB4khJZMpM5M/P78vNZkhLY8TFI8nL5UrM5kLDYktNJMXG40jL48nMZEvNZ8tNZkZHo8rM5MPEY0ZHJEnMZUlL5EtNJkXGpErM5cJCokrKqsvNZ0lLZUPD5EtNZcpMZExN6ElMJEjLpEVGI0nMJMND4stNZUxNp8tNZ0rNJUREpEpMpUtNJ0ZG5EHCIkfKo8pM5cvNpshLo8TFJMrNJkLDYstNJUXG48jL5EnMZMvNp8tNZsrM5UPEJEZHJMlL5MtNJsrNJcLDIkrK6svNp0pMpMlMJMnMJUpMpcZG5M////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB9SAA0NJLT4LN0k3C4SLLQuFh4mLBgCVlpeYmZqXHRoDGhA8IAQpJycpMSA2JiAPCjpECkQgCg8gHgGburuZQzMfOw4CGDo8ERs0AigbAjTFPDoYAg47RQ+UvNmbHSU5QCskFgghGDQ5K0A5DSxIJDQIDRhADR8sI9r4mSocSDg5CDhC0DjCAEm/FTAYkEBgBAcCCiJgICmRryKAEhokvCiAxEgBChQK/EAiQwQSEQVWeCQREseBexbzedKgQkgNIUISJMi5MyfOGjsT3BSSISa+Gp4CAQAh+QQIBgAAACwAAAAAPAAHAIYcGhx8mkykzkz8/vy81mSEtjxEUjScwkyszmQsNiS00kxcbjScxkSMvjy81ny01mRkejxkckSsykyszkw8RjScxlS0zmxcakyUvkQsMiSsqqy81nSszlwcIiSUtlQ8PkS01lykxkTE3oS00nSUwkQcHiR8qjy82myMukSkumw0Piy01lRkbjzE2ny01nSs0lRESkSkylS00mRkbkQcGiSEokykzly81myEujxMUkycwlSs0mQsNiy00lRcbjycxkyMvkS82ny01mxkckyszlQ8QkSUvkysrqy82nSs0lykykyUwkykyly00mxkbkz///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH/oADR04zQws+Tj4LhIszC4WHiY2PTgssFzwlNJqcm56doJ8fGgMaEEQiNy8tLS8nIj0rIg8KQUgKSCIKDyIysrRBQRIGmwAlJcbIx8nMy8fPRzkhQhsCREFEExs7Ai7VO8LXHAIOMkoP39hEKcnP7u/wyscfKj9NTAdNCCQcOz8xTX4wGGGDAYIdB4iMYKBkRAwGTTiQQICgGICLGDNqxKjsYgcYHpg0+IEACIkdOhowYQIkBssDCJYAQVABxUoUFUouQRAgns+f8zRQMFGAyZICFSoUMMIEh00gRY8eUAqECQocMYwU0FEjAw1jYDkZKya248VNR0rByMAjQ4YEGwnexn3rdi6PuHDftnXb4d0meX//Jvt7TAWpQAAh+QQIBgAAACwAAAAAPAAHAIYcHiR8qjy01lSMvjykxkQ8TjSszmT8/vy01nRcbjSkzkwsNiScwkxkejy00kysqqxkbkS01mTE2nyszkw8RjSEtjyUvkS00mS81nScwlS81mSszlwkKiSkylRUYkRkbjw8PkRkckSUtlSUwkS82nRMVjxccjw0PiycxkSs0lRESkSMukS00nS82mwcIiSMpky01lyMvkSkykys0mRcbjykzlwsNixseky00lSsrqxkbky01mzE3oSszlQ8QkSEujyUvky00my81nycxlS81mys0lwsMiSkylxkckyUwky82nxMUkycxkz///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH/oAHOToQSAk0OjQJhIsQCYWHiY2POgkfhoiKOiUuAJ6foKGfIA8HDw09PEQpEhIpLTw4AjwRDkokDiQ8DhE8F7O1SkoOLRI4MLQvnaLMoTlLBDsYCj1KPRMYMwoI0zPW1RsKQhcyEd3fQtoYOzIXHs3wniAnTEFHDEEGIxszTB1BTFCwuDfDAIoNAGWw6IAiyIYRBmYw6MCCCQEEN+LFUyHiyAAmBmKMmJFhwJEjMTrUGMDAQJIYBoasOLliSMgkLi3U6DCzRgGNzU48oBCgwpEkFYYMqQDkyI+ZKyp0QMpgaYwjK350AJJ0aZIjFWJkoAG0WakHKozYMGJkwYK2FW/bsrXx1i3ctmvl6l3AoawoG6UCAQAh+QQIBgAAACwAAAAAPAAHAIYcHiR8qjzE2nycxkS00kxMUkysqqy00mycwkykzkyEujwsNiRcbjS82mykzlxkejyUvkQ8RjRkckScxlS00mS81mxkakyMqkw8PkSszlwkKiSkxkS01myszkyMukQ0PiyUwkS81mSs0lz8/vy01lSswmwsOixkbjy82nxESkSkylS01ly81nxkbkSUtlSs0lSMvjwcIiSEtjzE3oScxky00lRUXjysrqy00nScwlQsNixcbjy82nSUvkw8QkRkcky81nSMqlSszmQsMiSkyky01nSszlSUwkys0mSkyly01mRkbkyMvkT///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH/oAjN0stPww7SzsMhIstDIWHiY2PSwwnhoiKjJA7Fh8AoKGioBgGIwYPRjMVLwICLw0zNSQzSgQoPAQ8MwRKMxS0tigoBA0CNSszKzWrrSgdNqPSoDcFGxxACUYoRh1ASAlF2Ujc2xkJLBRESuPlLOBARess2twJJdPSGB80B0kIB4SAyICEhooDNAbg+IdEyIAMCIngUDHgQAYQQpAgUIFjAI2JFR0KEaIh36gULpLAoCGECQgkOWAkScJEhQMYCIQcYSJkgoeZHia0PKITggMVPx14YMkEgpAgJkV9MBAhgIwkR2RMmCCjRxIFPz3IUJEVAVcmSTwoUNFDK9cjL0lkoBWLVUaOCyaihjJlIMUQHUOGLFggmLDgwDoIDy4sGPDhx4sXC46hF4AOU4EAACH5BAgGAAAALAAAAAA8AAcAhhweJHyqPMTafJzGRLTSTExaNKyqrLTSbKTOTIS6PDQ+LGR6PJS+RLzabFxuNKTOXCQuJJzGVLTSZLzWbJzCVGRuRERKRJzCTKzOXCQmJJSuTKTGRLTWbKzOTIy6RDxGNJTCRCw2JLzWZGRyRKzSXPz+/LTWVDw+RHSKTLzafGRuPKTKVLTWXLzWfKzSVIy+PBwiJIS2PMTehJzGTLTSVFReRKyurLTSdGR2TJS+TLzadFxuPCwyJLzWdJzCXGRuTExSTKzOZCQqJJS2VKTKTLTWdKzOVJTCTCw2LGRyTKzSZDxCRKTKXLTWZIy+RP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf+gCU2PxVJDjs/Ow6EixUOhYeJjY8/DiqGiIqMkJmTPzUwAKKiJwYlBgtGMhMuAgIuDTI0JjJNBCk6BDoyBE0yErS2KSkEDQI0LDIsNKutr7GztRpCo6M2QBscPQhGKUYdPUoIRdtK3t0YCC0SRE3l5y3iPUXtLdze4OLkRBIj1aQKZhxgcuFAEBAYlMxYcWDGgBsElQQZgKEhkRsrBhzAACKIkgsrbgyYgXGAxAEPLN5weADFP1EWhjB5MSOIExBKKLxgwsTJigcvLgQ54iRIBA88PUSweWQogwcrkD7wUJNBjqFOeL5YWuClAgMfAsRgciRGhAgxcjBJgNRDjBVDZS+gzeohwYocZtEeYRKD7tiyZ2MwWOvBx4KXAEwZsMADCQ8IIUJAlhyZR2PKIXhEhuwYsuXMkzWD3hzCseSXSEwFAgAh+QQIBgAAACwAAAAAPAAHAIYsMiR8qjzE2nycxkS00kxcbjS0znSsqqykzkyEujy01mw8RiyUvkRkckSkzly81mycxlS00mRcZlRMTkycwky81nyszlw0PiyMslSkxkRkbjyszkyMukRERkSUwkS82my81mSs0lwsNiT8/vy01lS00mxkejykylS01lys0lSMvjyEtjzE3oScxky00lRcbjysrqy01nQ8RjSUvkxkcky81nRkbkxMUkycwlS82nyszmSUtlSkykxkbkSszlRESkSUwky82nSs0mQsNiy00nSkyly01mSMvkT///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH/oAjMDY9NAUvNi8FhIs9BYWHiY2PNgUahoiKjJCZk5uYNhIHIwcmPiwPKQICKR8sLiQsRgQ5QQRBLARGLBGxszk5BB8CLigsKC6oqqyusLK0tkECPj0wNxkKNQg+OT4bNUIIMdpC3dwWCBURPEbk5hXhNTHsFdvd3+HjCOU+5wgGPy60KFGEQgkdHiwIaXGiRIsBRAoK0THAgkMeRE4MKGHBgw4hFE4QGdAi44CJAxxcJPKQIAWURUpc+LGjiIoWOo54EIJDRZEiR044UEFBB5AjOiBw+MkBQk4gRhk4OLHUAQecDGYYPfLTp4MjRYEw0LGjwwEZAVYUAbICAoQVSjOKJFjKYcUJthTecuWQ4MSMtm+BFFmxVy1btysYyKVrly0QDAtGHeggYggAACJEYNaM+fIQzZk3Y7bcuXTo0KIrX+b8GbPZEYEAACH5BAgGAAAALAAAAAA8AAcAhhweJISyPLTWVJTCRExeNKzOTPz+/DQ+LLTWdKyqrGR6NKTKTKzOZIS6PFxuNCQyJLTWZJzCTMTafGRuRLTSTExOTLTSZJS+RJS2RERGRLzWdKTKXCw2JLzWZJzCVKzOXDxGLIy6RGRyRLTOdLzadCQmJIyyVFxmVDw+RGyGNKTOTGRuPCwuJJzGRLzabIy+PBwiJIS2PLTWXJTCTFRmNKzOVKyurGR+PKTKVKzSZFxuPLTWbMTehGRuTLTSVLTSbJS+TJS2VLzWfKTOXCw2LLzWbJzGVKzSXGRyTLTSdLzafDxCRCwyJJzGTIy+RP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf+gAYJKACFhSU0PRMOig4TSA46PTqMixM9DiuQkpSNj5GTlaKfkicJBjYwhocYLjw+MjwQFEokFCQ8FBA8FgKytEoULhKwPDI+PEUFPBIFrsWztbcSNRM2hKsACipCFio7CCoWSjU1Sh/cFgsQGio55DVCOSoaCOtCKkckNQVK8zvt3pU7p2JEhWyFFHzI0QTHjwURfmwYkINBiw8/mixIgqPFjw8DGOSIgCNJiyYcI1RsMeRHi5JNPG5QaXHDjwPYVhEY4uHFhg0hjAy5EIHBDCcMjIT4GZSBkxlGLwzBsXTIiyYMLlww6oQpjiFOis7YGiRDAoTaAnSNsdRJDCNORgLMwBGja4gGOIC8NRJjxoa6QGNsmLE3BpANDZaGiIGD8AwTIE4lOIDwARMiDzhwYMKBCIfMnzVbJsIkMxPOpTVz3gwadOrTnjObNRAIACH5BAgGAAAALAAAAAA8AAcAhhweJHymRLTWVIy+PKTKTExOTKzOZPz+/LTWdCw2JJy+RLTSTFRmNKyqrKzSXFxuNKzOTDxGLIS2PLTWZMTafGRuRJS+RLTSZJzGRCQqJKTKXLzWdDw+RJS2VLzWZDQ+LIS6PGRyRJTCRLTOdLzadCQmJKTOTDQ6LJzCVGRuPKzOXDxCRJzGVLzabBwiJIyqTLTWXIy+RKTKVKzSZCw2LJzCTLTSVFxmVKyurFxuPKzOVIyyVLTWbMTehGRuTJS+TLTSbJzGTCwyJKTOXLzWfLzWbIy6RGRyTJTCTLTSdLzafERGRP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf+gAcNHACFhoeFETk+D4s5Dz4VDxWMKUeNPo+Rk5eOkJKbFZ0+Nw0HOC6IqgAMEBQkCyQ9CxM9FwI9EwtKSgstFDYwPTA2PUUQPRQQLT3BubuwJBQ6FTiEq4gKM0o6OkoqJkQXBBMbJtvdRDMmGwjkRCYOJDoQSus85uje4CMF2IguMADRgMHAjBoqgAQhkESGQBUiDNaQkQRDkIY1ZhjAMAQIBopBBGrIuFEDkBPX/hV6MSRGDQNIYhhgYUSDBiMsDMRAAtPCEBk1hwwIYsCCBZgxbBqR0fIlkqMdljRQaShBAAkskEiowUJCDKAgNPzA2hWJBq83JWjQyqLrDw0qIGoakSBDK5IdEUw1+EAVgAshCRIIoSE4MGDBgIUkPsyYseHFhAFLPRAIACH5BAgGAAAALAAAAAA8AAcAhhweJISyPLTWVJTCRDxOLKzOTPz+/LTWdFRqNKyqrCw2JKTKTKzOZIS6PFxyPLTWZJzCTMTafGRuPDxGLLTSTLTSZJS+RCQuJJSuRLzWdKTKXLzWZJzCVKzOXFxmVDw+RIy6RGRyRLTOdLzadCQmJIyyVFRiNFxuNDQ+LKTOTJzGRGRuTDxCRLzabIy+PBwiJIS2PLTWXJTCTExOTKzOVKyurCw2LKTKVKzSZFx2NLTWbMTehGRuRLTSVLTSbJS+TCwyJJS2VLzWfKTOXLzWbJzGVKzSXGRyTLTSdLzafFxuPJzGTERGRIy+RP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAf+gAYJHwCFhoeIhi8mKzwnPCsnEkcnSitKJ42PlJaYmpo8nCseCQY1L4mpiC8YDzsVAjsPFElJFC0RPTE7MT07RAU7EQUtO7qytCMUIxE0PDWEqtIACAsZPgsPGSlGSTQ0QjgpGQfZQtwjNAVJ4jrbON40SR0pIjPT0wg0PipLBzcQfDAYwAAHhBtI+iEBiIOBiiH8EC5R4UMDhIYqNPhAEQ1fIgJDirjQoAHEEgZNCMqwMOQGiBtDXJy0YIGBjCYkXw5pAsFmzSBMEnhUhSAAThANNPyAUaQIDBkaYByFoUEGU6c/NDQAURLGDasySkwolQDF0EQXgCgAovaCgrUQbhXEVWsDSNy5c+u6DWogEAAh+QQIBgAAACwAAAAAPAAHAIYcGhx8nkS00kyEujykylRMTkz8/vy00myUukQsMiS82myszmRcZlSUwkSs0lysykw0PixcbjSsqqycwkxcbkS81nSEtjy82ny00mRERkScwlRkbkQcIiSMukSkyly01myszlw8RixkckQcHiS01lSUvkQsNiSszkw8PkScxkSUtlTE2ny01lyMvjwcGiSEoky00lSkzkxMWjS00nS82nS0znSUwkys0mRcbjysrqy81nyMslScxlRkbkykzly01nRkckyUvkwsNiyszlQ8QkScxkzE3oS01mSMvkT///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAH/oAGEigjIy6GiACIh4qHjiONEBQ9ETg9OBE9GxEbQJWXmZuanJ6WDBIGORyMhZCuh66FirGHMgQrNAIKKzAsRiwwRhUnRisnCka9RkcCF7k0K0MbOYStirPWstmxAB0wF0MxOjcxFT8ERxUxDjRDJxfkH+o3Fw9DFyAxNQXa15Au/l7NGgipwQEfExYcSEFgRooiBzxMuLEghY+FDYukiJhiwY0JHg5AqIaoVSFY2EyaBBDAR4kGC2wgWcCjhQcfHYosKFEiJhIPHjoQ8IEkoY2eKjJI6MdKmysAAAACjFooQQALPHhYCELAQoegFgjYwKo1iIcBXztY8DDWxo4QIagkEFH51CldpxwSCEmQwISJvn718g0cuC9fIX+FKDUQCAAh+QQIBgAAACwAAAAAPAAHAIYcHiSEokS00kyEujxMTkykylT8/vy00myUvkQsNiRUZiy82mykymScxkRcZlSs0lw0Qiysqqyszky81nScwkyEsjy82nxkbkS00mQkKiSMukSkyly01myUwkQ8PkRcbjRERkSUtlRkckS01lRMWiw0Piy0znScxlQ8QkSszlyMslTE2ny01lyMvjwcIiS00lSkzky00nSUvkwsNixUZjS82nSszmScxkys0mQ8RiysrqyszlS81nycwlSEtjxkbkwsMiSkzly01nSUwkxcbjxkckxMWjTE3oS01mSMvkT///8AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAHzYAGER4AhYaHiImKhi5GRRcfF0UfRD9EHz+QmZGTlQ4RBjoui6SliAEsRywvRxMSRysSC0cvqUgCFjUCNSs7FzqEpsKLJDATBzAYPDAPNTsSFjgwHBMwOBY7OxYpMCYEw+CJCicHNzccBRQ4Ng1BBw0FMTcNBxvq7BsHJcHh4QlBBTRs2NDihg0ECGwMSTJQQ4EgSSgoTBgCRIR+GGlUEKjBx4YhPk6c8CFjwwCOPgqAHKIiB6gIJTCGc5GgJpAZQIDYtKkz54wEOi0aCAQAIfkECAYAAAAsAAAAADwABwCGHBokdI5EpMpM/P78vNZ0RE4shLY8rM5krK6sjL48LDIkrNJcnMJMXGZUND4srM5MtNZkXG40xN6ElLZUtNJklL5EZG5EpMpcxNp8hLo8tNJMnMJUREZEJC4krKqsvNp8NDYsPEYstM50lMJEZHJEtNZcHCIkjKpEpM5MvNpsjLJULDYknMZEPD5ErM5ctNZUHB4kdJZEpMpUTE5MjLZErNJkjL5ErM5UtNZ0XG48tNJslL5MZG5MpM5cjLpEtNJUnMZUtNJ0lMJMZHJMvNp0LDYsnMZMPEJE////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAB9aAAx4tMDAAhoiHiomMi46NMCs5PDkRPBaWmBZDEZMNHgMIJouFj4ilqKeHqoWIBQIYHxopEj8lEhAaH0QaRBg3FgiEraTEqazIq6uGJygfLigEFCgQOCgUHzc3zygiM6iOAKSKyqnljeIGIi4sBzpCMkECDDoXIzUHLBc6DsOnrcgAChxIEECAHhVGHBBiwwUQG0AOJGCwsMKBCRw8gCtWTpzHjyBDIuoQw4AQIAZ2XMjg44INAxeEmFQRApSHIwPHEdxZsJSJDiuCBgW6QgHRDkUyDggEACH5BAgGAAAALAAAAAA8AAcAhhweJHySPKTKTPz+/DxKLLzWdKzOZISyPKyurJzCTFxmVCw2JKzSXIy+PLTWZKzOTFxuNDxGLLTSZGRuRKTKXERWLJS2VJzCVCQqJMTehIy6RDw+RLTSTJS+RLTOdGRyRKTOTLzadIyyVJzGRDQ+LDxCRExWNLTWXBwiJKyqrKTKVExOTKzSZIS2PCw2LIy+RLTWdKzOVFxuPLTSbGRuTKTOXKTGXCwyJLTSVJTCTLTSdGRyTLzafJzGTERGRExaNP///wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAeDgAMpGwCFhoeIiYqLjCYTNBATOxAyNAopAwgojJydnoYBJxkOHDwhHCEZDxMIhJ+vsIURIw4wIBI8DzEFBiAeK7HBnxUCMDYjMxQ5LCwJKjMkrsLTiTcXFBo9NR0JBjkdBhY+KdTliBUHLdstPT0tOSIRmCkk5vYoCy43Ny76C+MDAgEAIfkECAYAAAAsAAAAADwABwCFHB4kdJJEpM5MXGo8hLY8/P78ND4svNp0rK6srM5knMJMTE5MLDIkZH48lL5EREZErKqsrM5UZG5MPEYstM50JCYkhKY8lLZUPD5ExN6EpMZMHCIkfJo8pM5cXGZUjLJUvNp8rNJknMZELDYslMJErNJcZHJEtNJ0PEJE////AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAABk7AAgQDKBqPyKRyyUwyBhIPpIDYNK/YLNKgOWQipqF2TFYGIodEJLEou92cUkIhoBiI7zy2kSA5EhcPEHqETQEEJB8TUxAGhY9IDAyCBUEAIfkECAYAAAAsAAAAADwABwCCHB4krKqsPD5E/P78HCIkrK6sPEJE////AyM4IdD+MMpJqQijkMq75wXzjWQnlmj6nGr7XW7sYYtsQ9eQAAA7) 50% 25%;
background-repeat: no-repeat;          
}
.overlay-msg{margin-bottom: 10px;bottom: 0px;position: absolute;font-style: italic;color: rgb(19, 19, 19);}             
</style>
<?php 
function get_file_size_unit($file_size){
switch (true) {
    case ($file_size/1024 < 1) :
        return intval($file_size ) ." Bytes" ;
        break;
    case ($file_size/1024 >= 1 && $file_size/(1024*1024) < 1)  :
        return intval($file_size/1024) ." KB" ;
        break;
	default:
	return intval($file_size/(1024*1024)) ." MB" ;
}
}
function display_download($BACKUP_DIR){
$msg='';
$msg.='<h2>COPIAS DE RESPALDOS GENERADOS</h2>
 <table><thead><tr><th>Archivos</th><th>Tamaño</th><th>&nbsp;</th></tr> 
</thead><tbody>';
$downloads=getDownloads($BACKUP_DIR);
if(count($downloads)>0)
foreach ($downloads as $k => $v) {
$msg.= '<tr><td>'.$v['name'].'</td><td>'.$v['size'].'</td><td>
<a class="tooltips" href="'.BACKUP_DIR . "/". $v['name'] .'" target="_blank"><span>Descargar</span><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAA8AAAAPCAYAAAA71pVKAAAAtElEQVR42mNgQAMGBgb+xsbGH42MjP7BMJC/X09PT4yBEAAq9Abi/+gYaIjPqGYokJGR4QRKbgIqOgykr+DQfBUkD8RbgJgLxQBDQ8NYoIIv2DQiGfAFqC4OqwuAcZwAVPANh8ZvQJyI18/AxOCLQ7MvNtus0YQYoQZ8h2r8DnSqH0gcW+h+wOYCfX39RKBtd0A0jlj5j1MzEVEK1vwRaHo6CfqYgN7IBGsGOm0uvujBE20NAHg8npa1TPgkAAAAAElFTkSuQmCC"/></a>
&nbsp;
</td></tr>';   
}
return $msg.='</tbody></table>';
}
function getDownloads($dir="./myBackups"){
    if (is_dir($dir)){
    $dh  = opendir($dir);
    $files=array();
    $i=0;
    $xclude=array('.','..','.htaccess');
    while (false !== ($filename = readdir($dh))) {
       if(!in_array($filename, $xclude))
       {
        $files[$i]['name'] = $filename;
        $files[$i]['size'] = get_file_size_unit(filesize($dir.'/'.$filename));
        $i++;
       }
    }
    return $files;
}}?>

<?php include_once "includes/footer.php"; ?>