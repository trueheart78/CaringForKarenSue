<?php
require "config.php";
Site::displayPageHeader();
/*
print " <article>
    <section>
      <h2>This is a headline for the first section</h2>
      <p>content</p>
      <p>more content...</p>
    </section>
<section>
      <h2>This is a headline for the second section</h2>
      <p>content</p>
      <p>more content...</p>
    </section>
  </article>";*/
db_Connect('test');
Site::displayRegistrationForm();
Site::displayPageFooter();
?>