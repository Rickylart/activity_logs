{{-- Publish model --}}
                                            <div class="modal fade" id="publish{{ $product->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog        ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Publish Product</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post"
                                                            action={{ route('product_status', $product->id) }}>
                                                            @csrf
                                                            @method('patch')
                                                            <div class="modal-body">
                                                                <div class="container">

                                                                    <div class="form-group row">
                                                                        <h1>Are you sure ? to publish <b
                                                                                class="text-danger">{{ $product->product_name }}</b>
                                                                        </h1>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-block btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-block btn-success">Publish</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                            <div class="modal fade" id="unpublish{{ $product->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog        ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Publish Product</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post"
                                                            action={{ route('product_status', $product->id) }}>
                                                            @csrf
                                                            @method('patch')
                                                            <div class="modal-body">
                                                                <div class="container">

                                                                    <div class="form-group row">
                                                                        <h1>Are you sure ? to unpublish <b
                                                                                class="text-danger">{{ $product->product_name }}</b>
                                                                        </h1>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-block btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-block btn-danger">Unpublish</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
                                            {{--End Publish model --}}

                                            {{-- edit model --}}
                                            <div class="modal fade" id="edit{{ $product->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog        ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post"
                                                            action={{ route('update', $product->id) }}>
                                                            @csrf
                                                            @method('patch')
                                                            <div class="modal-body">
                                                                <div class="container">
                                                                    <input type="text" hidden name="id"
                                                                        value="{{ $product->id }}"
                                                                        class="form-control" id="inputEmail4">

                                                                    <div class="col-md-12">
                                                                        <label for="inputEmail4"
                                                                            class="form-label">Product Name</label>
                                                                        <input type="text" name="product_name"
                                                                            value="{{ $product->product_name }}"
                                                                            class="form-control" id="inputEmail4">
                                                                        <span class="text-danger">
                                                                            @error('product_name')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label for="inputPassword4"
                                                                            class="form-label">Product Cost</label>
                                                                        <input type="text" name="product_cost"
                                                                            value="{{ $product->product_cost }}"
                                                                            class="form-control" id="inputPassword4">
                                                                        <span class="text-danger">
                                                                            @error('product_cost')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label for="inputPassword4"
                                                                            class="form-label">Product Type</label>
                                                                        <input type="text" name="product_type"
                                                                            value="{{ $product->product_type }}"
                                                                            class="form-control" id="inputPassword4">
                                                                        <span class="text-danger">
                                                                            @error('product_type')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-block btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-block btn-success">update</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>

                                            <!--Comment Modal -->
                                            <div class="modal fade" id="addComment{{ $product->id }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog        ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Comment
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form action={{ route('give_product_comment', $product->id) }}>
                                                            @csrf
                                                            <div class="modal-body">
                                                                <div class="container">

                                                                    <div class="form-group row">
                                                                        <label for=""
                                                                            class="col-sm-1-12 col-form-label">Enter /
                                                                            update product comment for <b
                                                                                class="text-danger">{{ $product->product_name }}</b></label>
                                                                        <div class="col-sm-1-12">
                                                                            <textarea class="form-control" name="comment">
                                                                    {{ $product->product_comment }}
                                                                </textarea>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-block btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-block btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>

                                            {{-- delete model --}}
                                            <div class="modal fade" id="delete{{ $product->id }}" tabindex="-1"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog        ">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="post"
                                                            action={{ route('destroy', $product->id) }}>
                                                            @csrf
                                                            @method('delete')
                                                            <div class="modal-body">
                                                                <div class="container">

                                                                    <div class="form-group row">
                                                                        <h1>Are you sure ? to delete <b
                                                                                class="text-danger">{{ $product->product_name }}</b>
                                                                        </h1>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button"
                                                                    class="btn btn-block btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-block btn-danger">Delete</button>
                                                            </div>
                                                        </form>

                                                    </div>

                                                </div>
                                            </div>
