<?php
$pageTitle = "View Books";
include 'db_connect.php';
include 'includes/header.php';

// Fetch stats
$countResult = $conn->query("SELECT COUNT(*) as total FROM books")->fetch_assoc();
$sumResult   = $conn->query("SELECT SUM(price) as total FROM books")->fetch_assoc();
$bookCount   = $countResult['total'] ?? 0;
$totalValue  = $sumResult['total'] ?? 0;
?>

<!-- Header with stats -->
<div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-5">
    <div>
        <h1 class="display-5 mb-1">Collection Archive</h1>
        <p class="text-muted">Manage your curated literary assets</p>
    </div>
    <div class="d-flex flex-column flex-sm-row gap-3 mt-3 mt-md-0 w-100 w-md-auto">
        <input type="text" id="bookSearch" class="form-control search-input" placeholder="Search records...">
        <a href="add_book.php" class="btn btn-primary"><i class="bi bi-plus-circle me-2"></i>Catalog New</a>
    </div>
</div>

<!-- Quick stats cards -->
<div class="row g-4 mb-5">
    <div class="col-sm-6">
        <div class="glass-card p-4 d-flex align-items-center">
            <i class="bi bi-collection fs-1 me-3 icon-primary"></i>
            <div>
                <span class="text-muted text-uppercase small fw-semibold">Total Entries</span>
                <h2 class="mb-0 display-6 price-tag"><?php echo sprintf("%02d", $bookCount); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-sm-6">
        <div class="glass-card p-4 d-flex align-items-center">
            <i class="bi bi-currency-dollar fs-1 me-3 icon-accent"></i>
            <div>
                <span class="text-muted text-uppercase small fw-semibold">Total Value</span>
                <h2 class="mb-0 display-6 price-tag">$<?php echo number_format($totalValue, 2); ?></h2>
            </div>
        </div>
    </div>
</div>

<!-- Books table -->
<div class="glass-card p-0 overflow-hidden">
    <table class="table align-middle" id="booksTable">
        <thead>
            <tr>
                <th>Asset details</th>
                <th>Valuation</th>
                <th class="text-end pe-4">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = $conn->query("SELECT * FROM books ORDER BY id DESC");
            if ($result && $result->num_rows > 0):
                while ($row = $result->fetch_assoc()):
            ?>
            <tr class="book-row">
                <td>
                    <div class="d-flex align-items-center">
                        <div class="me-3 d-none d-sm-block">
                            <i class="bi bi-book fs-3 icon-muted"></i>
                        </div>
                        <div>
                            <h6 class="mb-0 fw-semibold"><?php echo htmlspecialchars($row['title']); ?></h6>
                            <span class="italic-author small"><?php echo htmlspecialchars($row['author']); ?></span>
                            <span class="badge-ref ms-2">#<?php echo $row['id']; ?></span>
                        </div>
                    </div>
                </td>
                <td class="price-tag fs-5">$<?php echo number_format($row['price'], 2); ?></td>
                <td class="text-end pe-4">
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-secondary me-2"><i class="bi bi-pencil"></i></a>
                    <button onclick="confirmDelete(<?php echo $row['id']; ?>)" class="btn btn-sm btn-outline-secondary"><i class="bi bi-trash text-danger"></i></button>
                </td>
            </tr>
            <?php
                endwhile;
            else:
            ?>
            <tr>
                <td colspan="3" class="text-center py-5">
                    <div class="empty-state-icon mb-3"><i class="bi bi-journal-x"></i></div>
                    <h4 class="fw-normal">No entries yet</h4>
                    <p class="text-muted">Start by cataloging your first book.</p>
                    <a href="add_book.php" class="btn btn-primary mt-2"><i class="bi bi-plus-circle me-2"></i>Catalog New Asset</a>
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Live search script -->
<script>
    document.getElementById('bookSearch')?.addEventListener('keyup', function() {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#booksTable tbody .book-row');
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>

<?php include 'includes/footer.php'; ?>