<?php
try {
    print "this is our try block n";
    // throw new Exception();
} catch (Exception $e) {
    print "something went wrong, caught yah! n";
} finally {
    print "this part is always executed n";
}
?>
