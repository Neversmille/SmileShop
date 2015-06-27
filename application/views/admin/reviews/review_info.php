<div class="span12 block" id="content">
	<div class="row-fluid">
		<div class="navbar navbar-inner block-header">
                <div class="muted pull-left">Полная информация о отзыве</div>
        </div>
		<div class="block-content collapse in">
			<?=form_open('admin/review/'.$review_info["review_id"],array("class" => "form-horizontal","id" => "review_edit"));?>
				<?=form_hidden('review_id', $review_info["review_id"]);?>
				<div class="control-group">
					<label class="control-label">Статус:</label>
							<div class="controls">
								<?php
									$options = array("0" => "Отображаемый", "1" => "Удален");
									echo form_dropdown('review_is_delete', $options,$review_info["review_is_delete"]);
								;?>
								<?=form_error("review_is_delete");?>
							</div>
				</div>
				<div class="form-actions">
					<?=form_submit(array('name' => 'update_review',
										'class' => 'btn btn-primary',
										'value' => 'Изменить'));?>
					</div>

			<?=form_close();?>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Дата:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$review_info['review_time'];?> </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Имя:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$review_info['review_name'];?> </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">eMail:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$review_info['review_email'];?> </div>
			</div>
			<div class="control-group">
				<label class="control-label" for="inputEmail">Отзыв:</label>
				<div class="controls col-md-8 checkoutLabel"><?=$review_info['review_text'];?> </div>
			</div>
			<?php if(!empty($review_info['review_file'])):?>
				<div class="control-group">
					<label class="control-label" for="inputEmail">Файл:</label>
					<div class="controls col-md-8 checkoutLabel"><?=$review_info['review_filename'];?> </div>
					<img class="review-img" src="/asset/upload/reviews/<?=$review_info['review_file'];?>">
				</div>
			<?php endif;?>
		    </div>
		</div>
	</div>
</div>
