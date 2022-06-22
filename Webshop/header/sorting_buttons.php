<li>
    <form method="POST" class="form-inline">
        <strong>Sort by price:</strong>
        <label>
            <select name="how_sort">
                <option>auto</option>
                <option>ascending</option>
                <option>descending</option>
            </select>
        </label>
        <button class="btn btn-success" type="submit">Sort</button>
    </form>
</li>

<li>
    <form method="POST">
        <label for="number"><strong>Sort by price range:</strong></label>
        <label><input name="min" class="form-control" type="number" placeholder="min" required></label>
        <label><input name="max" class="form-control" type="number" placeholder="max" required></label>
        <label><button class="btn btn-success" type="submit">Sort</button></label>
    </form>
</li>

<li>
    <form method="POST" >
        <label for="text"><strong>Search by coin's title:</strong></label>
        <label><input name="product_search" style="width: 100%" type="text" class="form-control" placeholder="Enter tittle" required></label>
        <label><button class="btn btn-success" type="submit">Search</button></label>
    </form>
</li>