<el-form method="post" action="{{route('contact.store')}}" id="contact_form" label-width="100px">
  <el-form-item placeholder="Please Input Your Name" class="required" label="Name:">
    <input type="text" name="name" value="{{old('name')}}" class="el-input required"/>
  </el-form-item>
  <el-form-item label="Email:" placeholder="Please Input Your Email" class="required">
    <input type="text" name="email" value="{{old('email')}}" class="el-input required"/>
  </el-form-item>
  @if(isset($more)&&$more)
    <el-form-item label="Mobile:" placeholder="Please Input Your Mobile">
      <input type="text" name="phone" value="{{old('phone')}}" class="el-input required"/>
    </el-form-item>
  <el-form-item  label="Skype:" placeholder="Please Input Your Skype">
    <input type="text" name="skype" value="{{old('skype')}}" class="el-input required"/>
  </el-form-item>
  @endif
  <el-form-item label="Message:" placeholder="Please Input Your Message" class="required">
    <input type="text" name="msg" value="{{old('msg')}}" class="el-input required"/>
  </el-form-item>
  <el-form-item>
    <button class="el-button--primary el-button" type="submit">Submit</button>
  </el-form-item>
  @if(isset($product_id)&&$product_id)
    <input type="hidden" name="product_id" value="{{$product_id}}"/>
  @endif
  @if(isset($redirect)&&$redirect)
    <input type="hidden" name="redirect" value="{{$redirect}}"/>
  @endif
  @csrf
</el-form>
