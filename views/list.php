  <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=0;// placed to macth id 
                    // loop through obtained data and paint it
                    foreach($contacts as $contact)
                    { ?>
                    <tr>
                        <td><?php echo $contact['name']; ?></td>
                        <td><?php echo $contact['telephone']; ?></td>
                        <td><?php echo $contact['address']; ?></td>
                        <td>
                        <div style="float:left">
                              <form role="form" action="/trycatch/csvmanager/update.php" method="post" enctype='application/json' > 
                                  <input type="hidden" value="<?php echo utf8_encode(utf8_decode($contact['name']));?>"         name="name" id="name"/>
                                  <input type="hidden" value="<?php echo utf8_decode($contact['telephone']); ?>"   name="telephone" id="telephone"/>
                                  <input type="hidden" value="<?php echo htmlspecialchars(($contact['address']),ENT_COMPAT,"UTF-8"); ?>"     name="address" id="address"/>
                                  <input type="hidden" value="<?php echo $i; ?>"                      name="id" id="id" />
                                  <input type="hidden" value="edit"                      name="action" id="action" />
                                  <button type="submit" class="btn btn-default">Edit</button>
                              </form></div>
                                <div style="float:left">
                              <form role="form" action="/trycatch/csvmanager/delete.php" method="post" enctype='application/json' > 
                                  <input type="hidden" value="<?php echo $i; ?>" name="id" id="id" />
                                  <input type="hidden" value="delete"            name="action" id="action" />
                                  <button type="submit" class="btn btn-default" >Delete</button>
                              </form>
                              </div>
                        </td>
                    </tr>
                    <?php $i++;}?>
                     </tbody>
            </table>