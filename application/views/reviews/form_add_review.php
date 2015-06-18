<div class="form form-small">
    <!-- Review form -->
    <form class="form-horizontal" method="POST" action="/reviews" enctype="multipart/form-data">
         <!-- Review -->
        <div class="form-group">
            <label class="control-label col-md-3" for="text">Ваш отзыв:</label>
            <div class="col-md-8">
                <textarea class="form-control" id="text" rows="5" name="text"><?=set_value('text');?></textarea><?=form_error("text");?>
            </div>
        </div>
        <!-- File box -->
        <div class="form-group">
            <label class="control-label col-md-3">Файл:</label>
            <div class="col-md-6">
                <input type="file" id="inputFile" name="userfile" class="reviews">
                <div class="color"><?php if(isset($file_error)) echo $file_error; ?></div>
            </div>
        </div>
        <!-- Buttons -->
        <div class="form-group">
            <!-- Buttons -->
            <div class="col-md-6 col-md-offset-3">
                <button type="submit" name="add_review" class="btn btn-default">Отправить</button>
                <button type="reset" class="btn btn-default">Очистить</button>
            </div>
        </div>
    </form>
</div>
