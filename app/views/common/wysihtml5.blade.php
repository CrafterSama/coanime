<div id="wysihtml5-toolbar1">
  <header id="toolbar">
    <ul class="wysihtml5-toolbar radius">
      <li data-wysihtml5-command="bold" title="Make text bold (CTRL + B)" class="command"><i class="fa fa-bold fa-lg"></i></li>
      <li data-wysihtml5-command="italic" title="Make text italic (CTRL + I)" class="command"><i class="fa fa-italic fa-lg"></i></li>
      <li data-wysihtml5-command="insertUnorderedList" title="Insert an unordered list" class="command"><i class="fa fa-list-ul fa-lg"></i></li>
      <li data-wysihtml5-command="insertOrderedList" title="Insert an ordered list" class="command"><i class="fa fa-list-ol fa-lg"></i></li>
      <li data-wysihtml5-command="createLink" title="Insert a link" class="command"><i class="fa fa-chain fa-lg"></i></li>
      <li data-wysihtml5-command="insertImage" title="Insert an image" class="command"><i class="fa fa-photo fa-lg"></i></li>
      <li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h1" title="Insert headline 1" class="command"><i class="fa fa-header fa-lg"></i>1</li>
      <li data-wysihtml5-command="formatBlock" data-wysihtml5-command-value="h2" title="Insert headline 2" class="command"><i class="fa fa-header fa-lg"></i>2</li>
      <li data-wysihtml5-command="insertSpeech" title="Insert speech" class="command"></li>
      <li data-wysihtml5-action="change_view" title="Show HTML" class="action"><i class="fa fa-code fa-lg"></i></li>
    </ul>
  </header>
  <div id="link" data-wysihtml5-dialog="createLink" style="display: none;">
    <label >Link:</label>
      <input data-wysihtml5-dialog-field="href" placeholder="http://" class="form-control xs">
    <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;&nbsp;&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
  </div>

  <div id="image" data-wysihtml5-dialog="insertImage" style="display: none;">
    <label>Image:</label>
    <input data-wysihtml5-dialog-field="src" placeholder="http://" class="form-control">
    <a data-wysihtml5-dialog-action="save">OK</a>&nbsp;&nbsp;&nbsp;<a data-wysihtml5-dialog-action="cancel">Cancel</a>
  </div>
</div>