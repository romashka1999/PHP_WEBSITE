<?php if (!isLoggedIn()): ?>
    <div class="alert alert-danger">
        <h1>User In not Logged In</h1>
    </div>
<?php endif; ?>
<?php if (isLoggedIn()): ?>
<div class="card border-0 shadow my-5">
    <div class="card-body p-5">
        <table class="table table-striped">
            <thead>
            <tr class="bg-primary">
                <th>Lucky Number</th>
                <th>PayOut</th>
            </tr>
            </thead>
            <tbody class="bg-warning">
            <tr>
                <td>0-9800</td>
                <td>0</td>
            </tr>
            <tr>
                <td>9801-9900</td>
                <td>10</td>
            </tr>
            <tr>
                <td>9901-9950</td>
                <td>50</td>
            </tr>
            <tr>
                <td>9951-9999</td>
                <td>100</td>
            </tr>
            <tr>
                <td>10000</td>
                <td>1000</td>
            </tr>
            </tbody>
        </table>

        <form action="/games/luckyNumber" method="POST">
            <button class="btn btn-danger">1 Crystal</button>
        </form>


        <table class="table table-striped">
            <tr class="bg-primary">
                <th>Balance<i class="far fa-gem"></i></th>
                <th>Lucky Number</th>
                <th>You Won</th>
            </tr>
            <tr>
                <td id="balance"><?php echo currentUser('cristal');?></td>
                <td id="random"><?php echo isset($rand)?$rand:0;?></td>
                <td id="win"><?php echo isset($currentWin)?$currentWin:0;?></td>
            </tr>
        </table>
    </div>
</div>
<?php endif; ?>