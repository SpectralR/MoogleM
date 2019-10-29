@extends('layouts.app')

@section('content')
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente nisi explicabo cumque velit quae natus omnis! Commodi reprehenderit nam obcaecati quo quisquam, recusandae possimus ad vitae, officiis facilis at veritatis.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae labore, molestias magnam debitis dolorem sint vero praesentium aperiam nostrum voluptatibus vel, repellat eveniet repudiandae fuga suscipit officia neque in ipsa?</p>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Doloremque, voluptatum aut! Nemo placeat ducimus dignissimos assumenda. Vel ipsam eaque vitae maxime delectus animi, natus facilis ab? Incidunt laboriosam magni at.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Cum possimus deserunt cupiditate facilis voluptas eum blanditiis assumenda ut, debitis dolore numquam minima reiciendis consectetur nesciunt quia temporibus, suscipit necessitatibus! Omnis?</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque, voluptatum. Nihil eaque ducimus quisquam officia optio accusantium unde, nemo saepe, et labore, neque explicabo est! Qui enim dignissimos nisi saepe?</p>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Laborum molestiae maiores hic quis accusamus sit maxime doloremque ab vitae quod fugit nemo minima eveniet at ea alias, corporis provident ex!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores in facilis natus, numquam, assumenda qui voluptatem, repellat placeat sit sapiente nesciunt ratione! Illo maiores maxime omnis, inventore vel delectus totam!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid non nisi, labore amet officiis eum necessitatibus fugit assumenda magnam nihil nam repellendus qui similique autem harum cum iure recusandae saepe.</p>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ab temporibus repudiandae deserunt tempora maxime praesentium ullam incidunt commodi adipisci facilis accusantium, fugiat voluptatum asperiores et velit id culpa laudantium veniam.</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Adipisci asperiores soluta ab corporis maxime totam, molestiae consectetur officia magni cupiditate est suscipit tempora qui ad nostrum fugiat numquam. Vel, quidem.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae voluptatum officiis quam aliquid obcaecati est accusamus possimus placeat? Minima in rerum eos, recusandae obcaecati dolore. Fuga esse enim voluptatum eveniet.</p>
    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Porro est id ipsam, ab eaque cumque maiores quas iusto culpa! Quos, eum aliquid nisi a eveniet eius pariatur possimus quibusdam nulla!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque enim fugit, ipsum sint magni dicta voluptatibus, ipsam culpa consequuntur aut quisquam facere corporis in, dolorem error molestiae libero possimus eveniet?</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit eum fugiat quam placeat alias, aspernatur facilis voluptatum aut ea magni similique inventore est numquam optio, neque ex pariatur ullam veniam.</p>
    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Assumenda voluptatum ad cum doloribus dolore. Explicabo excepturi magnam voluptate nisi eaque, labore nam molestiae molestias quaerat, tenetur maxime. Iusto, unde pariatur!</p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos enim neque optio magnam possimus minima nobis delectus dolorum doloremque vel, placeat eveniet vitae voluptatem voluptate asperiores odit earum repudiandae officiis.</p>

    <aside>
        <div class='jumbotron raids'>
            <h4>Raids</h4>
            <div class="slicked">
            @foreach($instances as $instance)
            <div class="card border-secondary mb-3 raid">
                <div class="card-body">
                    <h4 class="card-title"><img src="https://xivapi.com{{ $instance->Icon }}" alt="{{ $instance->Name }}">
                    {{ $instance->Name }}</h4>
                    <p class="card-text"><span class="badge badge-pill badge-success">Success</span> OR <span class="badge badge-pill badge-danger">Failure </span></p>
                </div>
            </div>
            @endforeach
            </div>
        </div>
    </aside>
@endsection
