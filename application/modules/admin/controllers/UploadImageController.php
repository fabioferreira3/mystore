<?php
/************************
 * @author Christopher Hogan <ceo@foundco.com>
 ******************************/

class Admin_UploadImageController extends Zend_Controller_Action
{
  public $session;
  private $uploads = '/files';
  private $uploads_rel = '/files';

    public function init() {
        parent::init();  // this is just for session init (pulls session data for user_id, and email)
    }

  public function indexAction() {
     /* if ($this->_request->isOptions()) {  
        // we're using user_id and email here as a way to verify the upload and store the file in a specific directory,
        // you can strip that out for your purposes.
        $this->upload( $this->session->user['id'], $this->session->user['email'] );
      }
      if ($this->_request->isPost()) {
        $this->upload( $this->session->user['id'], $this->session->user['email'] );
      }
      if ($this->_request->isGet()) {
        $this->upload( $this->session->user['id'], $this->session->user['email'] );
      }
      if ($this->_request->isDelete() || $_SERVER['REQUEST_METHOD'] == 'DELETE') {
        $this->delete( $this->session->user['id'], $this->session->user['email'] );
      }
      exit;*/
  }

  public function uploadAction() {
$user_id = 45;
$email = 'fabio.ferreira3@outlook.com';
      if ($user_id && $email) {
          $adapter = new Zend_File_Transfer_Adapter_Http();
          $user_path = PUBLIC_PATH. $this->uploads_rel. $user_id;

          if (!file_exists($user_path)) mkdir($user_path);

          $adapter->setDestination(PUBLIC_PATH. $this->uploads_rel. $user_id);
          $adapter->addValidator('Extension', false, 'jpg,png,gif');

          $files = $adapter->getFileInfo();
          foreach ($files as $file => $info) {
              $name = $adapter->getFileName($file);

              // you could apply a filter like this too (if you want), to rename the file:     
              //  $name = ExampleLibrary::generateFilename($name);
              //  $adapter->addFilter('rename', $user_path . '/' .$name);

              // file uploaded & is valid
              if (!$adapter->isUploaded($file)) continue; 
              if (!$adapter->isValid($file)) continue;

              // receive the files into the user directory
              $adapter->receive($file); // this has to be on top

              $fileclass = new stdClass();

              // we stripped out the image thumbnail for our purpose, primarily for security reasons
              // you could add it back in here.
              $fileclass->name = str_replace(PUBLIC_PATH. $this->uploads_rel, 'New Image Upload Complete:   ', preg_replace('/\d\//','',$name));  
              $fileclass->size = $adapter->getFileSize($file);  
              $fileclass->type = $adapter->getMimeType($file);  
              $fileclass->delete_url = '/user/upload';
              $fileclass->delete_type = 'DELETE';
              //$fileclass->error = 'null';
              $fileclass->url = '/'; 

              $datas[] = $fileclass;
          }

          header('Pragma: no-cache');
          header('Cache-Control: private, no-cache');
          header('Content-Disposition: inline; filename="files.json"');
          header('X-Content-Type-Options: nosniff');
          header('Vary: Accept');
          echo json_encode($datas);
      }
  }

  public function delete($user_id, $email) {
      if ($user_id && $email) {
        $file_name = $this->_request->getParam('files');
        // this has been customized to remove only specific images in certain user_id folders
        // you should modify that to your needs
        $file_path = PUBLIC_PATH. $this->uploads_rel. $user_id. '/'. $file_name;
        $success = is_file($file_path) && $file_name[0] !== '.' && unlink($file_path);
      }
      echo json_encode($success);
  }

}