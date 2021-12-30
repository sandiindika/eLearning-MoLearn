<div class="register">
		<h2>Upload Lesson</h2>
		<form action="" id="form_uploadLesson" method="post" enctype="multipart/form-data">
			<input type="text" name="title" id="title" placeholder="Title of lesson">
			<textarea name="detailLesson" form="form_uploadLesson" placeholder="Description the Lesson here...."></textarea>
			<input type="file" name="fileLesson">
			<input type="hidden" name="idClass" value="<?php echo $idClass ?>">
			<div class="clear"></div>
			<input type="submit" name="uploadLesson" value="Upload">
		</form>
</div>