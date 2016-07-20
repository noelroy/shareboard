<?php
class ShareModel extends Model{
	public function Index(){
		$this->query('SELECT * FROM shares ORDER BY create_date DESC');
		$rows = $this->resultSet();
		return $rows;
	}

	public function add(){
		// Sanitize POST
		$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

		// Image uploading
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["pic"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

		if($post['submit']){
			if($post['title'] == '' || $post['body'] == '' || $post['link'] == ''){
				Messages::setMsg('Please Fill In All Fields', 'error');
				return;
			}

			// Uploading Image
			if (move_uploaded_file($_FILES["pic"]["tmp_name"], $target_file)) {
        		//echo "The file ". basename( $_FILES["pic"]["name"]). " has been uploaded.";
        		Messages::setMsg("The file ". basename( $_FILES["pic"]["name"]). " has been uploaded.", 'successMsg');
        		
    		} else {
    			Messages::setMsg('Sorry, there was an error uploading your file.' . ' ' .$target_file , 'error');
    			
    			//Messages::setMsg($target_file, 'error');
        		return;
    		}

			// Insert into MySQL
			$this->query('INSERT INTO shares (title, body, link, user_id, image) VALUES(:title, :body, :link, :user_id, :image)');
			$this->bind(':title', $post['title']);
			$this->bind(':body', $post['body']);
			$this->bind(':link', $post['link']);
			$this->bind(':user_id', $_SESSION['user_data']['id']);
			$this->bind(':image', $target_file);
			$this->execute();
			// Verify
			if($this->lastInsertId()){
				// Redirect
				header('Location: '.ROOT_URL.'shares');
			}
		}
		return;
	}
}