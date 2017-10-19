<?php
namespace IodogsFiles\Service;

use IodogsFiles\Form\ImageUploadForm,
	Aws\S3\S3Client;

class ImageUploadService
{
	protected $services;
	private $om;
	private $S3Service;

	public function __construct($om, $S3Service)
	{
		$this->om = $om;
		$this->S3Service = $S3Service;
	}

	public function deletePhotoById($photoId)
	{
		$photoId = (int) $photoId;
		if($photoId)
		{
			$File = $this->om->
			getRepository("\IodogsDoctrine\Entity\FileStorage")->
			findOneBy(
				array(
					'id' => $photoId
				)
			);
			$File->setIsDelete(1);
			$this->om->persist($File);
			$this->om->flush();
		}
	}

	public function uploadBreedImage($options)
	{
		if(is_array($options))
		{
			$file = (isset($options['file']['image-file-single'])) ? $options['file']['image-file-single'] : null;
			$fileName = (isset($options['file_name'])) ? $options['file_name'] : md5(microtime()).".jpg";
			if($file)
			{
				$httpAdapter = new \Zend\File\Transfer\Adapter\Http();
				$mimeValidator = new \Zend\Validator\File\MimeType('image/jpg,image/jpeg,image/png');
				$dirPath = './public/upload';
				$s3DirPath = 'breeds';
				$httpAdapter->setValidators(array($mimeValidator));
				if($httpAdapter->isValid($file['name']))
				{
                    $filePath = $dirPath . DIRECTORY_SEPARATOR . $fileName;
                    $s3FilePath = $s3DirPath . DIRECTORY_SEPARATOR . $fileName;

                    $httpAdapter->addFilter('File\Rename',
                        array(
                            'target' => $filePath,
                            'overwrite' => true
                        ));
                    $httpAdapter->receive($file['name']);
                    $fileExistValidator = new \Zend\Validator\File\Exists(array($dirPath));
                    if($fileExistValidator->isValid($filePath))
                    {
                        $this->resizeMaster($filePath, $filePath, 190, 190);
                        $this->S3Service->putObject($s3FilePath, $filePath);
                        return array('fileName' => $fileName);
                    }
				}


			}
		}
        throw new \Exception("Загрузка не удалась!");
	}

    public function uploadFiles($options)
	{
		if(is_array($options)){
			$upload_dir = (isset($options['upload_dir'])) ? $options['upload_dir'] : null;
			$min_size = (isset($options['min_size'])) ? $options['min_size'] : 5400;
			$max_size = (isset($options['max_size'])) ? $options['max_size'] : 3145728;
			$files = (isset($options['files'])) ? $options['files'] : null;
			$fileErrors = false;
			$filesUploadId = false;	 
			if($files){
		     //Получаем http adapter который будет переносить файлы из временной директории
		     $httpadapter = new \Zend\File\Transfer\Adapter\Http(); 
		     //Создаем переменную для валидации размера загружаемого файла в байтах минимум (100кб) максимум (3 мб)
		     $filesize  = new \Zend\Validator\File\Size(array('min' => $min_size, 'max' => $max_size ));
			 //Создаем переменную для валидации расширения загружаемого файла перечисляем через запятую или элементами массива
		     $extension = new \Zend\Validator\File\Extension(array('extension' => array('jpg,png,jpeg')));		    
		     //Создаем переменную для валидации mime типа загружаемого файла
  		     $mime = new \Zend\Validator\File\MimeType('image/jpg,image/jpeg,image/png');
		     //Определяем адрес директории для загрузки файла от корня
		     //$dirName = './public/upload/';
		     $dirName = "./http/upload/";
		     $s3DirName = "public/upload";
				if($upload_dir)
		     		$s3DirName = "public/upload/$upload_dir";
		     //Устанавливаем данную директорию для всех загружаемых файлов
		     //$httpadapter->setDestination($dirName);
		    //Пробегаемся по массиву файлов
	     	foreach($files['image-file'] AS $file){
	     	//Устанаваем валидаторы для файла
	     	$httpadapter->setValidators(array($filesize, $extension, $mime), $file['name']);
	     	//Если валидный файл
	     	 if($httpadapter->isValid($file['name'])) {
				//print_r($file);
				//Устанавливаем новое имя для файла
	         	$newFilename = md5(uniqid(mt_rand(100,30000), true)) .time(). '.' . "jpg";
	         	$smallFilename = "small_".$newFilename;	

	         	//Конечный путь для файла
	         	$filePath = $dirName . $newFilename;
	         	$smallFilePath = $dirName . DIRECTORY_SEPARATOR . $smallFilename;
	         	$s3SmallFilePath = $s3DirName . DIRECTORY_SEPARATOR . $smallFilename;
	         	$s3FilePath = $s3DirName . DIRECTORY_SEPARATOR . $newFilename;

	         	//Добавляем фильтр для переименовывания исходного файла в новое имя
	          	$httpadapter->addFilter('File\Rename', 
                array('target' => $filePath,              
               ));
				//Переносим файл в установленную папку	          
 				$httpadapter->receive($file['name']);
 				//Определяем валидатор проверки содержит ли папка данный файл
		        $existFiValidator = new \Zend\Validator\File\Exists(array($dirName));
		        //Если файл лежит в папке запишем поменяем размер и запишем в базу

		        if ($existFiValidator->isValid($filePath)) {
    				$this->resizeMaster($filePath, $filePath, 950, 950);
    				$this->resizeMaster($filePath, $smallFilePath, 300, 300);

					

					$this->S3Service->putObject($s3FilePath, $filePath);
					$this->S3Service->putObject($s3SmallFilePath, $smallFilePath);

					$FileStorage = new \IodogsDoctrine\Entity\FileStorage();
    				$FileStorage->setSmallFileName($smallFilename);
    				$FileStorage->setFileName($newFilename);
    				$FileStorage->setS3SmallFilePath("$s3SmallFilePath");
    				$FileStorage->setS3FilePath("$s3FilePath");
    				$FileStorage->setDirName($upload_dir);
    				$FileStorage->setSortOrder(100);
    				$FileStorage->setDate(new \DateTime("now"));
    				$this->om->persist($FileStorage);
					$this->om->flush();
                 	$filesUpload[] = $FileStorage->getId();
				}
		     
		    }
		    else {
		    	//Файл не прошел валидацию
		    	$fileErrors[] = array(
		    		"file_name" => $file['name'],
		    		"messages" =>$httpadapter->getMessages()
		    		);		    	
		    	}
		     }
		 
		 }
	    return array("fileUploadErrors" => $fileErrors, "upload_id" => $filesUpload);	
	}
	}	

	function resizeMaster($file_input, $file_output, $w_o, $h_o, $quality=90, $percent = false)
	{
	list($w_i, $h_i, $type) = getimagesize($file_input);
	if (!$w_i || !$h_i) return false;
	$types = array('','gif','jpeg','png');
	$ext = $types[$type];
	if ($ext)
	{
	$func = 'imagecreatefrom'.$ext;
	$img = $func($file_input);
	} 
	else
	return false;
	if($w_i<=$w_o && $h_i<=$h_o) {imagejpeg($img,$file_output,$quality);return 1;}
	if ($percent) 
	{
	$w_o *= $w_i / 100;
	$h_o *= $h_i / 100;
	}
	if ($w_i > $h_i) $h_o = $w_o/($w_i/$h_i);
	elseif ($w_i <= $h_i) $w_o = $h_o/($h_i/$w_i);
	if (!$h_o) $h_o = $w_o/($w_i/$h_i);
	if (!$w_o) $w_o = $h_o/($h_i/$w_i);
	$img_o = imagecreatetruecolor($w_o, $h_o);
	imagecopyresampled($img_o, $img, 0, 0, 0, 0, $w_o, $h_o, $w_i, $h_i);
	imagejpeg($img_o,$file_output,$quality);
	return 1;
	}

}