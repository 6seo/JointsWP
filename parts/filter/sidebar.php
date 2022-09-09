<aside>
  <form data-ajax="filter">
    <h2 data-ajax="title">Filter</h2>
    <p><?php
$categories = get_the_category( $id );
if( $categories ){
  // Assumes you just want the first category
  print 'You&#8217;re in the ' . $categories[ 0 ]->name . ' category';
}
?></p>
    <fieldset data-ajax="group">
      <label data-ajax="label" for="item-title">Search by name</label>
      <input data-ajax="input" type="text" id="item-title" name="item-title" placeholder="Youtube clone">
    </fieldset>
    <fieldset data-ajax="group">
      <label data-ajax="label" for="item-category">Category</label>
      <?php
      $categories = get_terms( array(
          'taxonomy' => 'category',
          'orderby'    => 'count',
          'order'      => 'DESC',
          'hide_empty' => false
      ) );
      ?>
        <?php foreach($categories as $category) : ?>
            <div data-ajax="input-group">
                <input type="checkbox" id="<?= $category->slug; ?>" name="item-categories[]" value="<?= $category->term_id; ?>"><label for="<?= $category->slug; ?>"><?= $category->name; ?></label>
            </div>        
        <?php endforeach; ?>
    </fieldset>
    <fieldset data-ajax="group">
      <label data-ajax="label">Keywords</label>
      <?php
      $keywords = get_terms( array(
          'taxonomy' => 'post_tag', 
          'count' => 5,
          'hide_empty' => true,
      ) );
      $count = count($keywords);
      if ( $count > 0 ){
        foreach($keywords as $keyword) :
          if ($keyword->count > 2) {
      ?>
        <div data-ajax="input-group">
          <input type="checkbox" id="<?= $keyword->slug; ?>" name="item-keywords[]" value="<?= $keyword->term_id; ?>"><label for="<?= $keyword->slug; ?>"><?= $keyword->name; ?></label>
        </div>
        <?php
        } 
        endforeach; 
      }
      ?>
    </fieldset>
    <fieldset data-ajax="group">
      <label data-ajax="label" for="item-order">Order by</label>
      <select data-ajax="input select" id="item-order" name="item-order">
        <option value="">List Order</option>
        <option value="Popularity">Popularity</option>
        <option value="Alphabetical">Alphabetical</option>
      </select>
    </fieldset>
    <fieldset data-ajax="group right">
      <button data-css-button="button red">Filter</button>
      <input type="hidden" name="action" value="filter">
    </fieldset>
  </form>
</aside>