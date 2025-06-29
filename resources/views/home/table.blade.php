<div class="container-fluid has-bg-overlay text-center text-light has-height-lg middle-items" id="book-table">
    <div class="">
        <h2 class="section-title mb-5">BOOK A TABLE</h2>

        <form action="{{ route('book.table') }}" method="POST">
            @csrf

            <div class="row mb-5">
                <!-- Table Selection -->
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <select name="table_id" class="form-control form-control-lg custom-form-control" required>
                        <option value="">-- Select Table --</option>
                        @foreach($tables as $table)
                            <option value="{{ $table->id }}">Table #{{ $table->id }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Phone -->
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="text" class="form-control form-control-lg custom-form-control" name="phone" placeholder="Phone Number" required>
                </div>

                <!-- Number of Guests -->
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="number" class="form-control form-control-lg custom-form-control" name="n_guest" placeholder="Number of Guests" max="20" min="1" required>
                </div>

                <!-- Time -->
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="time" class="form-control form-control-lg custom-form-control" name="time" required>
                </div>

                <!-- Date -->
                <div class="col-sm-6 col-md-3 col-xs-12 my-2">
                    <input type="date" class="form-control form-control-lg custom-form-control" name="date" required>
                </div>
            </div>

            <input type="submit" class="btn btn-lg btn-primary" id="rounded-btn" value="Book Table">
        </form>
    </div>
</div>
