{{-- resources/views/graphiql.blade.php --}}
{{-- Based on: https://github.com/graphql/graphiql/blob/main/examples/graphiql-cdn/index.html --}}
@php
    use MLL\GraphiQL\GraphiQLAsset;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>GraphiQL</title>
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }

        #graphiql {
            height: 100dvh;
        }

        #graphiql-loading {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .docExplorerWrap {
            overflow: auto !important;
        }
    </style>

    <script src="{{ GraphiQLAsset::reactJS() }}"></script>
    <script src="{{ GraphiQLAsset::reactDOMJS() }}"></script>
    <link rel="stylesheet" href="{{ GraphiQLAsset::graphiQLCSS() }}"/>
    <link rel="stylesheet" href="{{ GraphiQLAsset::pluginExplorerCSS() }}"/>
    <link rel="shortcut icon" href="{{ GraphiQLAsset::favicon() }}"/>
</head>

<body>

<div id="graphiql">
    <div id="graphiql-loading">Loading…</div>
</div>

<script src="{{ GraphiQLAsset::graphiQLJS() }}"></script>
<script src="{{ GraphiQLAsset::pluginExplorerJS() }}"></script>
<script>
    const fetcher = GraphiQL.createFetcher({
        url: '/', // POST requests go to root
    });

    const explorer = GraphiQLPluginExplorer.explorerPlugin();

    function GraphiQLWithExplorer() {
        return React.createElement(GraphiQL, {
            fetcher,
            plugins: [explorer],
            defaultQuery: `{
  __schema {
    queryType {
      name
    }
  }
}`, // This prevents the "query is missing" error
        });
    }

    ReactDOM.render(
        React.createElement(GraphiQLWithExplorer),
        document.getElementById('graphiql'),
    );
</script>

</body>
</html>
