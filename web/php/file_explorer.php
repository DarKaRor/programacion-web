<?php

# Directorio base
$fileDir = getcwd();

# Agregando las extensiones aceptadas
$extensions = [];
$extensions['php'] = 'php';
$extensions['html'] = 'html';
$extensions['css'] = 'css';
$extensions['exe'] = 'executable';
$images = array_fill_keys(['jpg','png','gif'],'image');
$documents = array_fill_keys(['doc','docx','txt','pdf'],'document');
$extensions = array_merge($extensions,$images,$documents);

$texto = '';
$nombre = '';


# Se redirecciona hacia la carpeta padre de la actual.
function goToParent(){
    chdir(realpath(getcwd().'/..'));
}

# Devuelve un directorio nuevo a partir del actual.
function get_folder_path($s){
    return getcwd().'\\'.$s;
}

# Irá hacia una carpeta especificada en el parámetro. De no existir, retorna Falso.
function goToFolder($s){
    $new_path =  get_folder_path($s);
    if (!file_exists($new_path)) return FALSE;
    chdir($new_path);
    return TRUE;
}

# Retorna TRUE si la carpeta es un disco duro. Falso si no.
function is_disk($dir){
    $dir = explode("\\",$dir);
    if (count($dir) == 2 and empty($dir[1])) return TRUE;
    return FALSE;
}

function get_extension($file){
    $data = explode('.',$file);
    if(count($data)<2) return FALSE;
    $type = $data[1];
    return $type;
}

# Retorna el tipo de extensión dependiendo si está contenida dentro del array asociativo $extensions.
function get_type($file){
    global $extensions;
    
    if (empty($file)) return 'unknown';
    if ($file[0] == '.') return 'folder';
    $type = get_extension($file);
    if($type == FALSE){
        if(is_dir(getcwd().'/'.$file)) return 'folder';
        return 'unknown';
    }
    if (array_key_exists($type,$extensions)) return $extensions[$type];
    return 'unknown';
}

# Separa las carpetas de los demás archivos y los devuelve como un array bidimensional donde el index [0] son las carpetas y el index [1] los archivos.
function slice_folders($files){
    $folders = [];
    for($i = 0;$i<count($files);$i++){
        $file = $files[$i];        
        $type = get_type($file);
        if($type == 'folder'){
            array_push($folders,$file);
            array_splice($files, $i,1); 
            $i--;
        }
    }
    return [$folders,$files];
}

# Obtiene el nombre de la imagen utilizada para el tipo de archivo especificado. Se usará como src en img
function get_image($type){
    switch($type){
        case 'image': return 'image.png';
        case 'folder': return 'folder.png';
        case 'unknown': return 'unknown.png';
        case 'document': return 'document.png';
        case 'executable': return 'executable.png';
        case 'php': return 'php.png';
        case 'css': return 'css.png';
        case 'html': return 'html.png';
    }

    return 'unknown.png';
}

# Función para crear una carpeta del nombre determinado en el directorio actual. Si la carpeta ya existe devolverá FALSE.
function create_folder($name){
    $name = trim($name);
    $path = getcwd().'/'.$name;
    if (!is_dir($path)){
        mkdir($path,0777);
        return TRUE;
    }
    return FALSE;
}

# Intercambia los Espacios a %20 para uso en los Link. Puede funcionar al reverso con el parámetro $inverse
function space_to_link($path,$inverse=FALSE){
    if ($inverse == FALSE) return str_replace(' ','%20',$path);
    return str_replace('%20',' ',$path);
}

# Cambia a el directorio especificado con parámetros extra.
function set_directory($dir){
    $dir = trim($dir);
    $dir = space_to_link($dir,TRUE);
    if(is_dir($dir)){
        chdir($dir);
        return TRUE;
    }
    return FALSE;
}

# Limita el número de letras que puede tener un string y duelve un string con la cantidad especificada y puntos suspensivos en caso de cumplir la condición.
function limit_words($s){
    $limit = 30;
    if (strlen($s)>=$limit) return trim(substr($s,0,$limit-3))."...";
    return $s;
}

# Si la dirección está puesta desde el método GET. Entonces se elije esa posición.
if(isset($_GET['dir'])){
    $dir = $_GET['dir'];
    set_directory($dir);
}

# Si se hace una request GET, se verificará si los parámetros txtfile y dir están llenos, y a partir de ahí se abrirá un archivo de texto que debería ser existente.
if($_SERVER['REQUEST_METHOD']==='GET'){
    if(isset($_GET['txtfile']) && isset($_GET['dir'])){
        $text_file = $_GET['txtfile'];
        $directory = $_GET['dir'];
        $full_path = $directory."/".$text_file;
        $full_path = space_to_link($full_path,TRUE);
        # Si el archivo existe, entonces se modificaran los valores de $texto y $nombre, que se ven dentro de los inputs del creador de archivos de texto.
        if(file_exists($full_path)){
            $archivo = $text_file;
            $fp = fopen($archivo,'r');
            $size = filesize($archivo);
            $contents = '';
            if($size>0) $contents = fread($fp,$size);
            $texto = $contents;
            $nombre = str_replace('.txt','',$text_file);
            fclose($fp);
            
        }
    }
}

# Si se hace un request de tipo POST.
if($_SERVER["REQUEST_METHOD"]==="POST"){
    $folder = '';

    # Si se obtiene el parámetro archivo, entonces se creará el archivo con los datos obtenidos.
    if(isset($_POST['archivo'])){

        $archivo = $_POST['name'].'.txt';
        $text = $_POST['text'];
        $fp = fopen($archivo,'w');
        fwrite($fp,$text);
        fclose($fp);
    }

    # Si se escribió un nuevo directorio en el input, se usará ese.
    if(isset($_POST['directory'])){

        $dir = $_POST['dir'];
        set_directory($dir);

        # Si obtiene el parametro folder, entonces se creará una nueva carpeta con el nombre obtenido.
        if(isset($_POST['folder'])){
            $folder = $_POST['folder'];
            create_folder($folder);
        }

        if (!empty($dir) and is_dir($dir)) chdir($dir);
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='../css/file_styles.css'>
    <link rel='icon' type='image/png' href='../images/folder.png'>
    <title>Bloc de Notas 29714201</title>
</head>
    <body>
        <form method='POST'>
        <label for="text">Directorio:</label>
        <input type='text' name='dir' value="<?php echo getcwd();?>">
        <label for="folder">Nombre de Nueva Carpeta:</label>
        <input type='text' name='folder'>
        <input type='submit' name='directory' value='Aceptar'>
        </form>
        <div id='explorer'>
            <?php
                $files = scandir(getcwd());
                $data = slice_folders($files);
                $files = $data[1];
                $folders = $data[0];
                for($i=0;$i<count($folders);$i++):
                    $file = $folders[$i];
                    $path = realpath(getcwd().'//'.$file);
                    $path = space_to_link($path);
                    $type = get_type($file);
                    $file = limit_words($file);
                    $img = "../images/".get_image($type);
                    
                ?>
                    <a class='item' href=<?php echo "?dir=".$path?>>
                        <img src=<?php echo $img ?> alt="">
                        <p><?php echo $file?></p>
                    </a>
                <?php endfor;
                for($i=0;$i<count($files);$i++):
                    $file = $files[$i];
                    $currentDir = getcwd();
                    $path = '';
                    $ext = get_extension($file);
                    $type = get_type($file);
                    if($ext == 'txt'){
                        $path='?dir='.$currentDir."&txtfile=".$file;
                    }
                    $file = limit_words($file);
                    $img = "../images/".get_image($type);
                ?>
                    <a class='item' href='<?php echo $path ?>'>
                        <img src=<?php echo $img ?> alt="">
                        <p><?php echo $file?></p>
                    </a>
                <?php endfor; ?>
        </div>
        <section id="textCreator">
            <h1>Creador de Archivos de Texto</h1>
            <form method='POST'>
                <textarea name="text" id="text" cols="30" rows="10" required><?php echo trim($texto) ?></textarea>
                <label for="name">Nombre del Archivo</label>
                <input type='text' name="name" value='<?php echo $nombre ?>' required></input>
                <input type='submit' name='archivo' value='Guardar'></input>
            </form>
        </section>
    </body>
</html>

