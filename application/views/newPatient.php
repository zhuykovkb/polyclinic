<form action="" enctype="multipart/form-data" method="post">
    <p>*Name:
        <br/>
        <input type="text" name="name" placeholder="Name"/>
    </p>

    <p>*Sex: <br/>
        <span>Male:
            <input type="radio" name="sex" value="male"/>
        </span>
        <span>Female:
            <input type="radio" name="sex" value="female"/>
        </span>
    </p>

    <p>Upload the photo
        </br>
        <input type="file" name="photo"/>
    </p>

    <p>*Patient`s card number (up to 6 characters, must be unique):
        <br/>
        <input type="text" name="card_num" placeholder="Patient Card Number"/>
    </p>

    <p>*City id (up to 4 characters):
        <br/>
        <input type="text" name="native_city_id" placeholder="City (id for now)"/>
    </p>

    <p>Insurance number (must be unique):
        <br/>
        <input type="text" name="insurance_num" placeholder="Insurance Number"/>
    </p>

    <p>E-mail (must be unique):
        <br/>
        <input type="text" name="email" placeholder="E-mail"/>
    </p>

    <p>
        <input type="submit" value="Save">
    </p>
</form>