@extends('layouts.app')

@section('content')
    <div class="section">
        <h3>Contact Us</h3>
        <div class="row">
            <div class="col s12 m6">
                <form action="#" method="POST">
                    @csrf
                    <div class="input-field">
                        <input id="name" name="name" type="text" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field">
                        <input id="email" name="email" type="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field">
                        <textarea id="message" name="message" class="materialize-textarea" required></textarea>
                        <label for="message">Message</label>
                    </div>
                    <button type="submit" class="btn waves-effect waves-light">Send Message</button>
                </form>
            </div>
            <div class="col s12 m6">
                <div class="video-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.0000000000005!2d123.00000000000001!3d10.000000000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTUP%20Visayas!5e0!3m2!1sen!2sph!4v00000000000!5m2!1sen!2sph"
                        width="100%" height="300" frameborder="0" style="border:0" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection