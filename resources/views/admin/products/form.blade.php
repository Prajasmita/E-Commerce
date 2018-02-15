<div class="form-group {{ $errors->has('product_name') ? 'has-error' : ''}}">
    <label for="product_name" class="col-md-4 control-label">{{ 'Product Name' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="product_name" type="text" id="product_name"
               value="{{ $product->product_name or ''}}">
        {!! $errors->first('product_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('sku') ? 'has-error' : ''}}">
    <label for="sku" class="col-md-4 control-label">{{ 'Sku' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="sku" type="text" id="sku" value="{{ $product->sku or ''}}">
        {!! $errors->first('sku', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('short_discription') ? 'has-error' : ''}}">
    <label for="short_discription" class="col-md-4 control-label">{{ 'Short Discription' }}<span
                class="require">*</span></label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="short_discription" type="textarea"
                  id="short_discription">{{ $product->short_discription or ''}}</textarea>
        {!! $errors->first('short_discription', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('long_discription') ? 'has-error' : ''}}">
    <label for="long_discription" class="col-md-4 control-label">{{ 'Long Discription' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="long_discription" type="textarea"
                  id="long_discription">{{ $product->long_discription or ''}}</textarea>
        {!! $errors->first('long_discription', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('price') ? 'has-error' : ''}}">
    <label for="price" class="col-md-4 control-label">{{ 'Price' }} <span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="price" type="text" id="price" value="{{ $product->price or ''}}">
        {!! $errors->first('price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('special_price') ? 'has-error' : ''}}">
    <label for="special_price" class="col-md-4 control-label">{{ 'Special Price' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="special_price" type="text" id="special_price"
               value="{{ $product->special_price or ''}}">
        {!! $errors->first('special_price', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('special_price_from_date') ? 'has-error' : ''}}">
    <label for="special_price_from_date" class="col-md-4 control-label">{{ 'Special Price From Date' }}</label>
    <div class="col-md-6">
        <div class='input-group date'>
            <input class="date form-control " data-provide="datepicker" name="special_price_from_date" type="text"
                   id="special_price_from_date" value="{{ $product->special_price_from_date or ''}}">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        {!! $errors->first('special_price_from_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('special_price_to_date') ? 'has-error' : ''}}">
    <label for="special_price_to_date" class="col-md-4 control-label">{{ 'Special Price To Date' }}</label>
    <div class="col-md-6">
        <div class='input-group date'>
            <input class="date form-control " data-provide="datepicker" name="special_price_to_date" type="text"
                   id="special_price_to_date" value="{{ $product->special_price_to_date or ''}}">
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-calendar"></span></span>
        </div>
        {!! $errors->first('special_price_to_date', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('image_name') ? 'has-error' : ''}}">
    <label for="image_name" class="col-md-4 control-label">{{ 'Image Name' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="image_name[]" type="file" id="image_name"
               value="{{ $product->image_name or ''}}" multiple>
        {!! $errors->first('image_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('quantity') ? 'has-error' : ''}}">
    <label for="quantity" class="col-md-4 control-label">{{ 'Quantity' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input class="form-control" name="quantity" type="text" id="quantity" value="{{ $product->quantity or ''}}">
        {!! $errors->first('quantity', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('meta_title') ? 'has-error' : ''}}">
    <label for="meta_title" class="col-md-4 control-label">{{ 'Meta Title' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="meta_title" type="text" id="meta_title"
               value="{{ $product->meta_title or ''}}">
        {!! $errors->first('meta_title', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('meta_discription') ? 'has-error' : ''}}">
    <label for="meta_discription" class="col-md-4 control-label">{{ 'Meta Discription' }}</label>
    <div class="col-md-6">
        <textarea class="form-control" rows="5" name="meta_discription" type="textarea"
                  id="meta_discription">{{ $product->meta_discription or ''}}</textarea>
        {!! $errors->first('meta_discription', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('meta_keyword') ? 'has-error' : ''}}">
    <label for="meta_keyword" class="col-md-4 control-label">{{ 'Meta Keyword' }}</label>
    <div class="col-md-6">
        <input class="form-control" name="meta_keyword" type="text" id="meta_keyword"
               value="{{ $product->meta_keyword or ''}}">
        {!! $errors->first('meta_keyword', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
    <label for="category" class="col-md-4 control-label">{{ 'Category' }} <span class="require">*</span></label>

    <div class="col-md-6">
        <select name="category[]" id="selected" data-cat = "{{ json_encode($cat) }}" class="form-control select2" multiple="multiple" data-placeholder="Select Category">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ (isset($product->product_id) && in_array($category->id,$cat)) ? ' selected="selected"' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
        {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('status') ? 'has-error' : ''}}">

    <label for="status" class="col-md-4 control-label">{{ 'Product status' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input name="status" value="1" type="radio"
               id="status" {{ isset( $product->status) ? $product->status == 1 ? 'checked' :'' : '' }}>Active
        <input name="status" value="0" type="radio"
               id="status" {{ isset( $product->status) ? $product->status == 0 ? 'checked' :'' : '' }}>Inactive
        {!! $errors->first('status', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('is_feature') ? 'has-error' : ''}}">

    <label for="is_feature" class="col-md-4 control-label">{{ 'Is Feature' }}<span class="require">*</span></label>
    <div class="col-md-6">
        <input name="is_feature" value="1" type="checkbox"
               id="is_feature" {{ isset( $product->is_feature) ? $product->is_feature == 1 ? 'checked' :'' : '' }}>
        {!! $errors->first('is_feature', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        <input class="btn btn-primary" type="submit" value="{{ $submitButtonText or 'Create' }}">
        <a href="{{ url('/admin/products') }}" class="btn btn-danger">Cancel</a>

    </div>
</div>
