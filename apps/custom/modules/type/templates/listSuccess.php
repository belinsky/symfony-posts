<div class="block vertical-container align-center">
  <table>
    <thead>
      <tr>
        <th>
          id
        </th>
        <th>
          name
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $type): ?>
        <tr>
          <td>
            <?php echo $type['id'] ?>
          </td>
          <td>
            <?php echo $type['name'] ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
