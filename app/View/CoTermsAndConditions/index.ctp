<!--
/**
 * COmanage Registry CO Terms and Conditions Index View
 *
 * Copyright (C) 2013 University Corporation for Advanced Internet Development, Inc.
 * 
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * 
 * http://www.apache.org/licenses/LICENSE-2.0
 * 
 * Unless required by applicable law or agreed to in writing, software distributed under
 * the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 *
 * @copyright     Copyright (C) 2013 University Corporation for Advanced Internet Development, Inc.
 * @link          http://www.internet2.edu/comanage COmanage Project
 * @package       registry
 * @since         COmanage Registry v0.8.3
 * @license       Apache License, Version 2.0 (http://www.apache.org/licenses/LICENSE-2.0)
 * @version       $Id$
 */-->
<?php
  $params = array('title' => $title_for_layout);
  print $this->element("pageTitle", $params);

  // Add buttons to sidebar
  $sidebarButtons = $this->get('sidebarButtons');

  if($permissions['add']) {
    $sidebarButtons[] = array(
      'icon'    => 'circle-plus',
      'title'   => _txt('op.add') . ' ' . _txt('ct.co_terms_and_conditions.1'),
      'url'     => array(
        'controller' => 'co_terms_and_conditions', 
        'action' => 'add', 
        'co' => $cur_co['Co']['id']
      )
    );
  }
  
  $this->set('sidebarButtons', $sidebarButtons);
?>

<table id="cous" class="ui-widget">
  <thead>
    <tr class="ui-widget-header">
      <th><?php print $this->Paginator->sort('description', _txt('fd.desc')); ?></th>
      <th><?php print $this->Paginator->sort('status', _txt('fd.status')); ?></th>
      <th><?php print $this->Paginator->sort('cou', _txt('fd.cou')); ?></th>
      <th><?php print _txt('fd.actions'); ?></th>
    </tr>
  </thead>
  
  <tbody>
    <?php $i = 0; ?>
    <?php foreach ($co_terms_and_conditions as $c): ?>
    <tr class="line<?php print ($i % 2)+1; ?>">
      <td>
        <?php
          print $this->Html->link($c['CoTermsAndConditions']['description'],
                                  array('controller' => 'co_terms_and_conditions',
                                        'action' => ($permissions['edit'] ? 'edit' : ($permissions['view'] ? 'view' : '')),
                                        $c['CoTermsAndConditions']['id'],
                                        'co' => $cur_co['Co']['id']));
        ?>
      </td>
      <td><?php print _txt('en.status', null, $c['CoTermsAndConditions']['status']); ?></td>
      <td>
        <?php
          if(!empty($c['CoTermsAndConditions']['cou_id'])) {
            if(!empty($c['Cou']['name'])) {
              print $c['Cou']['name'];
            } else {
              print $c['CoTermsAndConditions']['cou_id'];
            }
          }
        ?>
      </td>
      <td>
        <?php
          if($permissions['edit'])
            print $this->Html->link(_txt('op.edit'),
                                    array('controller' => 'co_terms_and_conditions',
                                          'action' => 'edit',
                                          $c['CoTermsAndConditions']['id'],
                                          'co' => $cur_co['Co']['id']),
                                    array('class' => 'editbutton')) . "\n";
            
          if($permissions['delete'])
            print '<button class="deletebutton" title="' . _txt('op.delete') . '" onclick="javascript:js_confirm_delete(\'' . _jtxt(Sanitize::html($c['CoTermsAndConditions']['description'])) . '\', \'' . $this->Html->url(array('controller' => 'co_terms_and_conditions', 'action' => 'delete', $c['CoTermsAndConditions']['id'], 'co' => $cur_co['Co']['id'])) . '\')";>' . _txt('op.delete') . '</button>';
        ?>
        <?php ; ?>
      </td>
    </tr>
    <?php $i++; ?>
    <?php endforeach; ?>
  </tbody>
  
  <tfoot>
    <tr class="ui-widget-header">
      <th colspan="4">
        <?php print $this->Paginator->numbers(); ?>
      </th>
    </tr>
  </tfoot>
</table>