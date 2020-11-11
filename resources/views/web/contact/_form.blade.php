<form class="form-group" method="post" action="{{$action??route('contact.store')}}" id="contact_form">
  <div class="form-row">
    <div class="form-group col-6">
      <label>Name</label>
      <input type="text" placeholder="Please Input Your Name" name="name" value="{{old('name')}}" class="form-control required"/>
    </div>
    <div class="form-group col-6">
      <label>Email</label>
      <input type="text" placeholder="Please Input Your Email" name="email" value="{{old('email')}}" class="form-control required"/>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-6">
      <label>Country</label>
      <input type="text" placeholder="Please Input Your country" name="country" value="{{old('country')}}" class="form-control"/>
    </div>
    <div class="form-group col-6">
      <label>Phone</label>
      <input type="text" placeholder="Please Input Your Phone" name="phone" value="{{old('phone')}}" class="form-control"/>
    </div>
  </div>

  @if(isset($more)&&$more)
    <div class="form-row">
      <div class="form-group col-6">
        <label>Skype</label>
        <input type="text" placeholder="Please Input Your Skype" name="skype" value="{{old('skype')}}" class="form-control"/>
      </div>
    </div>

  @endif

  <div class="form-row">
    <div class="form-group">
      <label>Message</label>
      <textarea class="required form-control" placeholder="Please Input Your Message" name="msg" rows="3" cols="80">{{old('msg')}}</textarea>
    </div>
  </div>
    <button class="btn btn-primary" type="submit">Get a Quote</button>

  @if(isset($product_id)&&$product_id)
    <input type="hidden" name="product_id" value="{{$product_id}}"/>
  @endif
  @if(isset($redirect)&&$redirect)
    <input type="hidden" name="redirect" value="{{$redirect}}"/>
  @endif
  @csrf
</form>
