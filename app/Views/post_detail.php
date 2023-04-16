<h1>Tieu de san pham</h1>
<p>
</p>

<form action="<?php echo url('/post') ?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="put" />
    <input type="text" name="name"> <br>
    <input type="text" name="email"> <br>
    <input type="text" name="gender"> <br>
    <input type="file" name="file">
    <button>OK</button>

</form>

<table>
    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Function</td>
    </tr>
    <?php foreach ($students as $student): ?>
    <tr>
        <td><?php echo $student->id ?></td>
        <td><?php echo $student->name ?></td>
        <td>
            <a href="<?php echo url('/edit'.$student->id) ?>">Sua</a>
        </td>
        <td>
            <a href="<?php echo url('/destroy'.$student->id) ?>">Xoa</a>
        </td>
    </tr>
    <?php endforeach ?>
</table>

<?php
$message = session()->get('errors');
dd($message, session()->all());
if (! empty($message)) { ?>
    <h3>
        <?php echo json_encode($message) ?>
    </h3>
<?php } ?>