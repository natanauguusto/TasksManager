<div class="container center list attachments border">
<h2>Attachments</h2>
<ul class="container center list">
    <?php foreach($attachments as $attachment): ?>
        
        <li>
            <div class="container center border">
                <h4><?=$attachment->nome?></h4>
                <a href="<?=downloadFile($attachment->nome)?>" class="button download ">Download</a>
            </div>
        </li>
        
    <?php endforeach ?>
</ul>
</div>